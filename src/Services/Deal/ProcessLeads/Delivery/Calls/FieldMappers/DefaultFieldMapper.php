<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\FieldMappers;


use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Abstracts\AbstractFieldMapper;


class DefaultFieldMapper extends AbstractFieldMapper
{
    public function map(): mixed
    {
        $this->value = '';
        return $this->getValue();
    }
}
