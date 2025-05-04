<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Procedures;

use Innoboxrr\Deals\Models\DealAssignment;
use Innoboxrr\Deals\Models\DealRouterExecution;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Loggers\DeliveryLogger;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\DeliveryResult;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Contracts\CallTypeInterface;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\Support\ObjectMapping;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\CallResult;

class Call
{
    public static function dispatch(
        DealAssignment $assignment, 
        DealRouterExecution $execution,  
        DeliveryLogger $logger, 
        CallTypeInterface $call,
        ?DeliveryResult $prevResult = null
    ): DeliveryResult
    {

        // Paso 1: Construir el objeto de envío
        ObjectMapping::map($call, $assignment, $prevResult);

        // Paso 2: Inicializar el cliente
        /** @var CallResult $callResult */
        $callResult = $call->defineClient()->execute();

        // Paso 4: Construir resultado final
        $result = DeliveryResult::fromArray([
            'status' => $callResult->status,
            'input' => $callResult->input,
            'output' => $callResult->output,
            'call' => $call,
            'assignment' => $assignment,
        ]);

        $logger->log($result);

        return $result;
    }
}
