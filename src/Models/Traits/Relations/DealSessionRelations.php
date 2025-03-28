<?php

namespace Innoboxrr\Deals\Models\Traits\Relations;

use Innoboxrr\Deals\Models\DealLead;
use Innoboxrr\Deals\Models\DealGateway;
use Innoboxrr\Deals\Models\DealSessionEvent;
// use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait DealSessionRelations
{
    public function lead()
    {
        return $this->belongsTo(DealLead::class, 'deal_lead_id');
    }

    public function gateway()
    {
        return $this->belongsTo(DealGateway::class, 'deal_gateway_id');
    }

    public function events()
    {
        return $this->hasMany(DealSessionEvent::class, 'deal_session_id');
    }
}
