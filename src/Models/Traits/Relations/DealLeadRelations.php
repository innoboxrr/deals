<?php

namespace Innoboxrr\Deals\Models\Traits\Relations;

use Innoboxrr\Deals\Models\DealGateway;
use Innoboxrr\Deals\Models\DealSession;
use Innoboxrr\Deals\Models\DealLeadTrackingEvent;

// use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait DealLeadRelations
{
    public function dealGateway()
    {
        return $this->belongsTo(DealGateway::class, 'deal_gateway_id');
    }

    public function sessions()
    {
        return $this->hasMany(DealSession::class, 'deal_lead_id');
    }

    public function trackingEvents()
    {
        return $this->hasMany(DealLeadTrackingEvent::class, 'deal_lead_id');
    }
}
