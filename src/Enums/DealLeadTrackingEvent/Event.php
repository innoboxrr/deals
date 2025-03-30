<?php

namespace Innoboxrr\Deals\Enums\DealLeadTrackingEvent;

use Innoboxrr\Deals\Support\Traits\EnumTrait;

enum Event: string
{
    use EnumTrait;

    case CLICK = 'click';
    case OPEN = 'open';
    case UNSUBSCRIBE = 'unsubscribe';
    case FORWARD = 'forward';
    case REPLY = 'reply';
    case BOUNCE = 'bounce';
    case SPAM = 'spam';
    case DELIVERED = 'delivered';
    case DELIVERED_OPENED = 'delivered_opened';
    case DELIVERED_CLICKED = 'delivered_clicked';
}