<?php

/**
 * Estos son los estados de la asignación, y para la llamada es CallStatus
 */

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Enums;

enum DeliveryStatus: string
{
    case SUCCESS = 'success';
    case FAILURE = 'failure';
    case PENDING = 'pending';

    public function isSuccess(): bool
    {
        return $this === self::SUCCESS;
    }

    public function isFailure(): bool
    {
        return $this === self::FAILURE;
    }

    public function isPending(): bool
    {
        return $this === self::PENDING;
    }
}
