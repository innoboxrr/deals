<?php

namespace Innoboxrr\Deals\Enums\DealAdCampaignRule;

use Innoboxrr\Deals\Support\Traits\EnumTrait;

enum ConditionType: string
{
    use EnumTrait;

    case COST_PER_LEAD_GREATER_THAN = 'cost_per_lead_greater_than';
    case COST_PER_LEAD_LESS_THAN = 'cost_per_lead_less_than';
    case CONVERSION_RATE_GREATER_THAN = 'conversion_rate_greater_than';
    case CONVERSION_RATE_LESS_THAN = 'conversion_rate_less_than';
    case CLICK_THROUGH_RATE_GREATER_THAN = 'click_through_rate_greater_than';
    case CLICK_THROUGH_RATE_LESS_THAN = 'click_through_rate_less_than';
}