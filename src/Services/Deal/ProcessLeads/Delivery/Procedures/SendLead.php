<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Procedures;

use Innoboxrr\Deals\Models\DealAssignment;
use Innoboxrr\Deals\Models\DealRouterExecution;
use Innoboxrr\Deals\Enums\DealAssignment\Status as DealAssignmentStatus;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Loggers\DeliveryLogger;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Procedures\Call;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Enums\CallType;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Enums\CallStatus;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Contracts\CallTypeInterface;
use Illuminate\Support\Facades\App;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\DeliveryResult;
use InvalidArgumentException;

class SendLead 
{

    public static function run(
        DealAssignment $assignment, 
        DealRouterExecution $execution, 
        DeliveryLogger $logger
    ): void
    {
        $assignment->delivery_deal_router_execution_id = $execution->id;
        $callsResults = [];
        $prevResult = null;

        foreach ($assignment->advertiserAgreement->calls as $call) {
            
            $callObject = self::resolveCallObject(
                $call['type'], 
                $call, 
                $assignment
            );

            /** @var DeliveryResult $result */
            $result = Call::dispatch(
                $assignment, 
                $execution, 
                $logger,
                $callObject,
                $prevResult
            );
            
            $prevResult = $result;
            $callsResults[] = $result;

            if($result->break()) {
                break;
            }
        }

        /// Pensar bien como debería ser esto.
        $globalResult = self::globalResult(callsResults: $callsResults);
        
        if($globalResult['status']) {
            $assignment->status = DealAssignmentStatus::VALID->value;
        } else {
            $assignment->status = DealAssignmentStatus::INVALID->value;
        }

        $assignment->save();

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
        $allValid = true;
        $message = null;
    
        foreach ($callsResults as $result) {
            if ($result->status !== CallStatus::VALID->value) {
                $allValid = false;
                $message = "Falló la llamada de tipo '{$result->call->type()}' con estado '{$result->status}'";
                break;
            }
        }
    
        return [
            'status' => $allValid,
            'message' => $message,
            'failing_call' => $allValid ? null : $result->call->all(),
            'statuses' => array_map(fn($r) => [
                'type' => $r->call->type(),
                'status' => $r->status,
            ], $callsResults),
        ];   
    }   
}