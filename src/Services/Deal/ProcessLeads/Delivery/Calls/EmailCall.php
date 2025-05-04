<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Abstracts\AbstractCall;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Enums\CallType;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\ClientResponse;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\Clients\EmailClient;

class EmailCall extends AbstractCall
{
    public function type(): string
    {
        return CallType::EMAIL->value;
    }

    public function defineClient(): self
    {
        $client = EmailClient::set($this)->buildClient();
        $this->setClient($client);
        return $this;
    }

    public function validateResponse(ClientResponse $response):ClientResponse
    {
        return $response;
    }
}
