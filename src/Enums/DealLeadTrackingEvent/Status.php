<?php

namespace Innoboxrr\Deals\Enums\DealLead;

use Innoboxrr\Deals\Support\Traits\EnumTrait;

enum Status: string
{
    use EnumTrait;

    case DISPATCHED = 'dispatched';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
    case CANCELLED = 'cancelled';
    case PENDING = 'pending';
    case EXPIRED = 'expired';
    case BLOCKED = 'blocked';
}