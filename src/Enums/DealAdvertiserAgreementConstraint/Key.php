<?php

namespace Innoboxrr\Deals\Enums\DealAdvertiserAgreementConstraint;

use Innoboxrr\Deals\Support\Traits\EnumTrait;

enum Key: string
{
    use EnumTrait;

    case GENDER = 'gender';
    case AGE = 'age';
    case COUNTRY = 'country';
    case CITY = 'city';
    case STATE = 'state';
    case POSTAL_CODE = 'postal_code';
    case DEVICE = 'device';
    case OS = 'os';
    case BROWSER = 'browser';
    case ISP = 'isp';
    case LANGUAGE = 'language';
    case INTEREST = 'interest';
    case CUSTOM = 'custom';

}