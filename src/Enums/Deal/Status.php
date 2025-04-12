<?php

namespace Innoboxrr\Deals\Enums\Deal;

use Innoboxrr\Deals\Support\Traits\EnumTrait;

enum Status: string
{
    use EnumTrait;

    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case PENDING = 'pending';
}