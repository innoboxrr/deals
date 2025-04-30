<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Contracts;

interface CallTypeInterface
{
    public function type(): string;

    // Métodos comunes que cada Call debe implementar si deseas usarlos desde Strategy
    // Por ejemplo:
    // public function getPayload(): array;
    // public function getHeaders(): array;
}
