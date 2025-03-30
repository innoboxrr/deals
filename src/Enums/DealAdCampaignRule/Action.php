<?php

namespace Innoboxrr\Deals\Enums\DealAdCampaignRule;

use Innoboxrr\Deals\Support\Traits\EnumTrait;

enum Action: string
{
    use EnumTrait;

    case PAUSE = 'pause';
    case RESUME = 'resume';
    case DELETE = 'delete';
    case NOTIFY = 'notify';
    case NOTIFY_AND_PAUSE = 'notify_and_pause';
    case NOTIFY_AND_RESUME = 'notify_and_resume';
    case NOTIFY_AND_DELETE = 'notify_and_delete';
}