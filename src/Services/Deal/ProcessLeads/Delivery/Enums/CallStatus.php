<?php

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
