<?php

namespace Innoboxrr\Deals\Models\Traits\Relations;

use Innoboxrr\Deals\Models\DealLead;
use Innoboxrr\Deals\Models\DealPixelFire;

// use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait DealLeadTrackingEventRelations
{
    public function lead()
    {
        return $this->belongsTo(DealLead::class, 'deal_lead_id');
    }

    public function pixelFires()
    {
        return $this->hasMany(DealPixelFire::class, 'deal_lead_tracking_event_id');
    }
}
