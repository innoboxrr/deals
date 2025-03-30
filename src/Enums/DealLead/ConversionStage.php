<?php

namespace Innoboxrr\Deals\Enums\DealLead;

use Innoboxrr\Deals\Support\Traits\EnumTrait;

enum ConversionStage: string
{
    use EnumTrait;

    case NEW = 'new';
    case ON_QUEUE = 'on_queue';
    case ASSIGNED = 'assigned';
    case REJECTED = 'rejected';
    case SOLD = 'sold';
}