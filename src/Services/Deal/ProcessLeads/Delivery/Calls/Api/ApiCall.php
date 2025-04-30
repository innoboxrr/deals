<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\Api;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Enums\CallType;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Abstracts\AbstractCall;

class ApiCall extends AbstractCall
{
    public function type(): string
    {
        return CallType::API->value;
    }

    public function endpoint(): string
    {
        return $this->get('endpoint');
    }

    public function headers(): array
    {
        return $this->get('headers', []);
    }

    public function payload(): array
    {
        return $this->get('payload', []);
    }
}
