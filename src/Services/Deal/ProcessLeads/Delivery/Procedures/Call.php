<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Procedures;

use Innoboxrr\Deals\Models\DealAssignment;
use Innoboxrr\Deals\Models\DealRouterExecution;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Loggers\DeliveryLogger;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\DeliveryResult;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Contracts\CallTypeInterface;


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
        $input = ObjectMapping::map($call, $assignment, $prevResult);

        dd($input);

        $callResult = $call->execute();

        $logger->log(
            $callResult->status, 
            $call->type(), 
            $assignment, 
            $callResult->input, 
            $callResult->output
        );

        $result = DeliveryResult::fromArray([
            'status' => $callResult->status,
            'input' => $callResult->input,
            'output' => $callResult->output,
            'type' => $call->type(),
            'assignment' => $assignment,
            'execution' => $execution,
        ]);

        return $result;
    }
}
