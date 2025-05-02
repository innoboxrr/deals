<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Enums\CallType;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\CallResult;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Abstracts\AbstractCall;

class ApiCall extends AbstractCall
{
    public function type(): string
    {
        return CallType::API->value;
    }

    public function execute(): CallResult
    {
        dd(json_encode($this->data));


        // Autenticate
        dd($this->assignment->lead->lead);

        // Validate endpoints

        return CallResult::fromArray([
            'status' => true,
            'input' => $this->payload(),
            'output' => [],
            'message' => null,
            'break' => false,
        ]);
    }
}
