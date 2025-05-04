<?php

/**
 * Estos son los estados de la llamada, y después para el resultado global de la asignación es DeliveryStatus
 */

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Enums;

enum CallStatus: string
{
    case PENDING = 'PENDING';
    case SUCCESS = 'SUCCESS';
    case ERROR = 'ERROR';
    case VALID = 'VALID';
    case INVALID = 'INVALID';
    case RESOLVED = 'RESOLVED';
    case REJECTED = 'REJECTED';
    case TIMEOUT = 'TIMEOUT';
}
