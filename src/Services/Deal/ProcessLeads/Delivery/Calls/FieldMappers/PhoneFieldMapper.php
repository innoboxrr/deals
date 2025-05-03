<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\FieldMappers;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Abstracts\AbstractFieldMapper;

class PhoneFieldMapper extends AbstractFieldMapper
{
    public function map(): mixed
    {
        $this->value = $this->lead['phone'];

        $this->value = '52 7294470019';

        return $this->getValue();
    }
}
