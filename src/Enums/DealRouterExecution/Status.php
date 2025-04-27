<?php

namespace Innoboxrr\Deals\Enums\DealRouterExecution;

use Innoboxrr\Deals\Support\Traits\EnumTrait;

enum Status: string
{
    use EnumTrait;

    case UNPROCESSED = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
}