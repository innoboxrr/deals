<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Enums\CallType;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\CallResult;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Abstracts\AbstractCall;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\Clients\ApiClient;

class ApiCall extends AbstractCall
{
    public function type(): string
    {
        return CallType::API->value;
    }

    public function defineClient(): void
    {
        $client = ApiClient::set($this)->buildClient();
        $this->setClient($client);
    }

    public function validateResponse():void
    {
        dd($this->getClient()->getResponse());
    }
}
