<?php

namespace Innoboxrr\Deals\Enums\DealLead;

use Innoboxrr\Deals\Support\Traits\EnumTrait;

enum Status: string
{
    use EnumTrait;

    case UNPROCESSED = 'unprocessed';
    case UNASSIGNED = 'unassigned';
    case ASSIGNED = 'assigned';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
}