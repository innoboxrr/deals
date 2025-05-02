<?php

namespace Innoboxrr\Deals\Enums\DealAssignment;

use Innoboxrr\Deals\Support\Traits\EnumTrait;

enum Status: string
{
    use EnumTrait;

    // This is the first status of the assignment process.
    // It indicates that the assignment process has started.
    case ASSIGNED = 'assigned';

    // This status indicates that the assignment process is in progress.
    case IN_PROGRESS = 'in_progress';

    case VALID = 'valid';
    case INVALID = 'invalid';
    case PENDING = 'pending';
    case DUPLICATE = 'duplicate';
    case OUT_OF_DATE = 'out_of_date';
    case OUT_OF_HOUR = 'out_of_hour';
    case ERROR = 'error';
    
    public static function queueStates(): array
    {
        return [
            self::ASSIGNED->value,
            self::IN_PROGRESS->value,
            self::OUT_OF_DATE->value,
            self::OUT_OF_HOUR->value,
        ];
    }
}