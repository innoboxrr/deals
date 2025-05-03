<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\FieldMappers;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Abstracts\AbstractFieldMapper;
use Carbon\Carbon;

class DateofbirthFieldMapper extends AbstractFieldMapper
{
    public function map(): mixed
    {
        $dob = $this->lead['dob'] ?? null;

        if(!$dob) return null;

        $dob = Carbon::parse($dob);
        $formatted = $this->format($dob);

        $this->setValue($formatted);

        return $this->getValue();
    }

    public function format($value) 
    {
        return match ($this->field['format']) {
            'age' => $value->age,
            default => $value,
        };
    }
}
