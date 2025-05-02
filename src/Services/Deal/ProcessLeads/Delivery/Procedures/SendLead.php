<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Procedures;

use Innoboxrr\Deals\Models\DealAssignment;
use Innoboxrr\Deals\Models\DealRouterExecution;
use Innoboxrr\Deals\Enums\DealAssignment\Status as DealAssignmentStatus;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Loggers\DeliveryLogger;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Procedures\Call;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Enums\CallType;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Contracts\CallTypeInterface;
use Illuminate\Support\Facades\App;
use InvalidArgumentException;

class SendLead 
{

    public static function run(DealAssignment $assignment, DealRouterExecution $execution, DeliveryLogger $logger): void
    {
        $assignment->delivery_deal_router_execution_id = $execution->id;
        $callsResults = [];
        $prevResult = null;
        foreach ($assignment->advertiserAgreement->calls as $call) {
            $callObject = self::resolveCallObject($call['type'], $call, $assignment);
            $result = Call::dispatch(
                $assignment, 
                $execution, 
                $logger,
                $callObject,
                $prevResult
            );
            $prevResult = $result;
            
            $callsResults[] = $result->toArray($call['type']);
            if($result->break()) {
                break;
            }
        }

        /// Pensar bien como debería ser esto.
        $globalResult = self::globalResult($callsResults);
        $assignment->delivery_status = $globalResult['status'] ? DealAssignmentStatus::VALID->value : DealAssignmentStatus::INVALID->value;
        $assignment->delivery_message = $globalResult['message'] ?? null;

        return;
    }

    protected static function resolveCallObject(string $type, array $call, $assignment): CallTypeInterface
    {
        $callType = CallType::tryFrom(strtolower($type));

        if (! $callType) {
            throw new InvalidArgumentException("Tipo de entrega no soportado: {$type}");
        }

        $class = $callType->callClass();

        if (!class_exists($class)) {
            throw new InvalidArgumentException("Clase de llamada no encontrada: {$class}");
        }

        return App::make($class, ['data' => $call, 'assignment' => $assignment]);
    }

    protected static function globalResult(array $callsResults): array
    {
        $globalResult = [
            'status' => true,
            'input' => [],
            'output' => [],
            'message' => null,
            'break' => false,
        ];

        foreach ($callsResults as $result) {
            if ($result['status'] === false) {
                $globalResult['status'] = false;
                $globalResult['break'] = true;
                $globalResult['message'] = $result['message'];
                break;
            }
        }

        return $globalResult;
    }
}