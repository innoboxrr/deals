<?php

namespace Innoboxrr\Deals\Enums\DealAdvertiserAgreement;

use Innoboxrr\Deals\Support\Traits\EnumTrait;

enum Status: string
{
    use EnumTrait;

    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case PENDING = 'pending';
    case SUSPENDED = 'suspended';
    case DELETED = 'deleted';
    case ARCHIVED = 'archived';
    case EXPIRED = 'expired';
    case BLOCKED = 'blocked';
}