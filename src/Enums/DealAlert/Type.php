<?php

namespace Innoboxrr\Deals\Enums\DealAlert;

use Innoboxrr\Deals\Support\Traits\EnumTrait;

enum Type: string
{
    use EnumTrait;

    case HIGH_CPL = 'high_cpl';
    case LOW_CPL = 'low_cpl';

    case HIGH_CONVERSION_RATE = 'high_conversion_rate';
    case LOW_CONVERSION_RATE = 'low_conversion_rate';

    case LEADS_STUCK = 'leads_stuck';
    case LEAD_OVERLOAD = 'lead_overload';
    case LEAD_UNDERLOAD = 'lead_underload';

    case LOW_LEAD_QUALITY = 'low_lead_quality';
    case HIGH_LEAD_QUALITY = 'high_lead_quality';

    case LOW_LEAD_VOLUME = 'low_lead_volume';
    case HIGH_LEAD_VOLUME = 'high_lead_volume';

    case LOW_LEAD_COUNT = 'low_lead_count';
    case HIGH_LEAD_COUNT = 'high_lead_count';

    case LOW_LEAD_VALUE = 'low_lead_value';

    // 🔥 Sugerencias adicionales útiles
    case AGENT_NO_ACTIVITY = 'agent_no_activity';
    case AGENT_LOW_CONVERSION = 'agent_low_conversion';
    case LEAD_NO_RESPONSE = 'lead_no_response';
    case HIGH_DUPLICATE_RATE = 'high_duplicate_rate';
    case LEAD_REASSIGNMENT_NEEDED = 'lead_reassignment_needed';
    case SLA_BREACH = 'sla_breach';
}
