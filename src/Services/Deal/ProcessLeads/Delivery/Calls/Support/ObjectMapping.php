<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\Support;

use Innoboxrr\Deals\Models\DealAssignment;
use Innoboxrr\Deals\Support\Helpers\ArrayHelper;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Contracts\CallTypeInterface;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\DeliveryResult;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\Callables\GlobalParseObjectCallable;

class ObjectMapping
{
    public static function map(CallTypeInterface $call, DealAssignment $assignment, ?DeliveryResult $prevResult = null): void
    {
        $lead = $assignment->lead->lead->toArray();
        $data = $call->all();
        $mapped = [];

        foreach ($data['mapping'] ?? [] as $field) {
            $value = self::mapField(
                $field, 
                $lead, 
                $prevResult
            );
            $mapped[$field['target']] = $value;
        }

        $nested = ArrayHelper::dotNotationToNestedArray($mapped);

        if((int) $data['use_custom_code'] ?? false) {
            $nested = GlobalParseObjectCallable::execute(
                $data['parse_object'] ?? null, 
                $nested, $lead, $prevResult
            );
        }
        
        $call->setInput($nested);
    }

    protected static function mapField(array $field, array $lead, ?DeliveryResult $prevResult = null)
    {
        $source = $field['source'] ?? null;

        // Convertir ip_address => IpAddress
        $classBase = str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $source)));
        $class = '\\Innoboxrr\\Deals\\Services\\Deal\\ProcessLeads\\Delivery\\Calls\\FieldMappers\\' . $classBase . 'FieldMapper';

        if (!class_exists($class)) {
            $class = '\\Innoboxrr\\Deals\\Services\\Deal\\ProcessLeads\\Delivery\\Calls\\FieldMappers\\DefaultFieldMapper';
        }

        $mapper = new $class($field, $lead, $field['value'] ?? null, $prevResult);

        return $mapper->map();
    }

}