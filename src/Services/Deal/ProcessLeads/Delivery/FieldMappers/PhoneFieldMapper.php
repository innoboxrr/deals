<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\FieldMappers;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Abstracts\AbstractFieldMapper;

class PhoneFieldMapper extends AbstractFieldMapper
{
    public function map(): mixed
    {
        $this->value = $this->lead['phone'];

        $this->value = 123456789;

        return $this->getValue();
    }
}
