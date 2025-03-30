<?php

namespace Innoboxrr\Deals\Enums\DealAdvertiserAgreementInvoice;

use Innoboxrr\Deals\Support\Traits\EnumTrait;

enum Status: string
{
    use EnumTrait;

    case PENDING = 'pending';
    case PAID = 'paid';
    case UNPAID = 'unpaid';
    case REFUNDED = 'refunded';
    case CANCELLED = 'cancelled';
    case FAILED = 'failed';
    case DISPUTED = 'disputed';
    case CHARGEBACK = 'chargeback';
}