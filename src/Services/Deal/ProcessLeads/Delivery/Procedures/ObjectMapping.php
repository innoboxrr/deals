<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Procedures;

use Innoboxrr\Deals\Models\DealAssignment;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Contracts\CallTypeInterface;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\DeliveryResult;

class ObjectMapping
{
    public static function map(CallTypeInterface $call, DealAssignment $assignment, ?DeliveryResult $prevResult = null): array
    {
        $lead = $assignment->lead->lead->toArray();
        $data = $call->all();
        $mapped = [];

        foreach ($data['mapping'] ?? [] as $key => $field) {

            dd($field, $lead);

        }
        

        return $mapped;
    }
}