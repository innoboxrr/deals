<?php

namespace Innoboxrr\Deals\Enums\DealAdvertiserAgreementConstraint;

use Innoboxrr\Deals\Support\Traits\EnumTrait;

enum Operator
: string
{
    use EnumTrait;
    
    case EQUAL = '=';
    case NOT_EQUAL = '!=';
    case GREATER_THAN = '>';
    case GREATER_THAN_OR_EQUAL = '>=';
    case LESS_THAN = '<';
    case LESS_THAN_OR_EQUAL = '<=';
    case IN = 'IN';
    case NOT_IN = 'NOT IN';
    case LIKE = 'LIKE';
    case NOT_LIKE = 'NOT LIKE';
    case BETWEEN = 'BETWEEN';
    case NOT_BETWEEN = 'NOT BETWEEN';
}