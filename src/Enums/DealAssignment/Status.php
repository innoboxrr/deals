<?php

namespace Innoboxrr\Deals\Enums\DealAssignment;

use Innoboxrr\Deals\Support\Traits\EnumTrait;

enum Status: string
{
    use EnumTrait;

    // This is the first status of the assignment process.
    // It indicates that the assignment process has started.
    case ASSIGNED = 'ASSIGNED';

    // This status indicates that the assignment process is in progress.
    case IN_PROGRESS = 'IN_PROGRESS';

    case VALID = 'VALID';
    case INVALID = 'INVALID';
    case PENDING = 'PENDING';
    case DUPLICATE = 'DUPLICATE';
    case OUT_OF_DATE = 'OUT_OF_DATE';
    case OUT_OF_HOUR = 'OUT_OF_HOUR';
    case ERROR = 'ERROR';
    
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