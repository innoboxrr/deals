<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Abstracts;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Contracts\CallClientInterface;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Contracts\CallTypeInterface;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\ClientResponse;

abstract class AbstractCallClient implements CallClientInterface
{
    protected CallTypeInterface $call;
    protected ClientResponse $clientResponse;

    public function __construct(CallTypeInterface $call)
    {
        $this->call = $call;
    }

    public static function set(CallTypeInterface $call): static
    {
        return new static($call);
    }

    public function getCall(): CallTypeInterface
    {
        return $this->call;
    }

    public function getClient(): CallClientInterface
    {
        return $this;
    }

    abstract public function buildClient(): self;

    abstract public function execute(): ClientResponse;
}