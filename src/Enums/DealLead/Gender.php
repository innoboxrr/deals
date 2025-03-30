<?php

namespace Innoboxrr\Deals\Enums\DealLead;

use Innoboxrr\Deals\Support\Traits\EnumTrait;

enum Gender: string
{
    case MALE = 'male';
    case FEMALE = 'female';
    case OTHER = 'other';
    case UNDEFINED = 'undefined';
}