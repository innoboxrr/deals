<?php

namespace Innoboxrr\Deals\Enums\DealAlert;

use Innoboxrr\Deals\Support\Traits\EnumTrait;

enum Status: string
{
    use EnumTrait;

    case UNRESOLVED = 'unresolved';
    case RESOLVED = 'resolved';
    case ESCALATED = 'escalated';
    case CLOSED = 'closed';
    case DISMISSED = 'dismissed';
    case ARCHIVED = 'archived';
    case DELETED = 'deleted';
}