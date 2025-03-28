<?php

namespace Innoboxrr\Deals\Models\Traits\Relations;

use Innoboxrr\Deals\Models\DealLeadTrackingEvent;
use Innoboxrr\Deals\Models\DealAdPlatform;
// use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait DealPixelFireRelations
{
    public function trackingEvent()
    {
        return $this->belongsTo(DealLeadTrackingEvent::class, 'deal_lead_tracking_event_id');
    }

    public function adPlatform()
    {
        return $this->belongsTo(DealAdPlatform::class, 'platform_id')->where('platform_type', 'DealAdPlatform');
    }

    /*
    public function affiliate()
    {
        return $this->belongsTo(config('deals.models.affiliate'), 'platform_id')->where('platform_type', 'Affiliate');
    }
    */
}
