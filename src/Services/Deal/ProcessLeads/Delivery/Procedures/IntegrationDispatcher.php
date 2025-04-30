<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Procedures;

use Innoboxrr\Deals\Models\DealRouterExecution;
use Innoboxrr\Deals\Models\DealAdvertiserAgreement;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Contracts\DeliveryStrategyInterface;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Enums\CallType;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Loggers\DeliveryLogger;
use Illuminate\Support\Facades\App;
use InvalidArgumentException;

class IntegrationDispatcher
{
    public static function run(DealRouterExecution $execution, DeliveryLogger $logger): void
    {
        
        $currentAssignments = $execution->assignment_log['assignments'] ?? [];

        dd($currentAssignments);


        foreach ($currentAssignments as $assignment) {

            $leadId = $assignment['lead_id'];
            $agreementId = $assignment['assigned_agreement_id'];
            $calls = self::getCallsFromAgreement($agreementId);

            foreach ($calls as $call) {

                $strategy = self::resolveStrategy($call['type']);
                $callObject = self::resolveCallObject($call['type'], $call);
                $result = $strategy->dispatch($execution, $leadId, $agreementId, $callObject);

                $logger->logCall([
                    'lead_id' => $leadId,
                    'agreement_id' => $agreementId,
                    'type' => $call['type'],
                    'sent_object' => $result->sentObject,
                    'response' => $result->response,
                    'status' => $result->status,
                ]);

                if (!$result->isSuccess() && ($call['stop_on_error'] ?? false)) {
                    break;
                }

                if ($result->isSuccess() && ($call['stop_on_success'] ?? false)) {
                    break;
                }

                if ($result->pending()) {
                    $logger->logPending([
                        'lead_id' => $leadId,
                        'agreement_id' => $agreementId,
                        'type' => $call['type'],
                        'note' => 'Delivery marcado como pendiente por la estrategia',
                    ]);
                }
            }
        }
    }

    protected static function getCallsFromAgreement(int $agreementId): array
    {
        $agreement = DealAdvertiserAgreement::find($agreementId);
        if (! $agreement) {
            throw new InvalidArgumentException("Acuerdo no encontrado: {$agreementId}");
        }
        return $agreement->calls ?? [];
    }

    protected static function resolveStrategy(string $type): DeliveryStrategyInterface
    {
        $callType = CallType::tryFrom(strtolower($type));

        if (! $callType) {
            throw new InvalidArgumentException("Tipo de entrega no soportado: {$type}");
        }

        $class = $callType->strategyClass();

        if (!class_exists($class)) {
            throw new InvalidArgumentException("Clase de estrategia no encontrada: {$class}");
        }

        return App::make($class);
    }

    protected static function resolveCallObject(string $type, array $call): object
    {
        $callType = CallType::tryFrom(strtolower($type));

        if (! $callType) {
            throw new InvalidArgumentException("Tipo de entrega no soportado: {$type}");
        }

        $class = $callType->callClass();

        if (!class_exists($class)) {
            throw new InvalidArgumentException("Clase de llamada no encontrada: {$class}");
        }

        return App::make($class, ['data' => $call]);
    }
}