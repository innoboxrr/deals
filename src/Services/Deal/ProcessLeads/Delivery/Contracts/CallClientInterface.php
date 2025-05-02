<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Contracts;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\ClientResponse;

interface CallClientInterface
{
    public function getClient(): CallClientInterface;

    public function getResponse(): ?ClientResponse;

    public function buildClient(): self;

    public function execute(): void;
}