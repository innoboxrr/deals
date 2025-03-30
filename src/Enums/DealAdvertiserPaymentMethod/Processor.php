<?php

namespace Innoboxrr\Deals\Enums\DealAdvertiserPaymentMethod;

use Innoboxrr\Deals\Support\Traits\EnumTrait;

enum Processor: string
{
    use EnumTrait;

    case PAYPAL = 'paypal';
    case STRIPE = 'stripe';
    case BANK = 'bank';
    case WIRE = 'wire';
    case CHECK = 'check';
    case CASH = 'cash';    
}