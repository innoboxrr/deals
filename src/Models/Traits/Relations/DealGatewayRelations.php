<?php

namespace Innoboxrr\Deals\Models\Traits\Relations;

use Innoboxrr\Deals\Models\Deal;
use Innoboxrr\Deals\Models\DealLead;
use Innoboxrr\Deals\Models\DealSession;

// use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait DealGatewayRelations
{
    public function deal()
    {
        return $this->belongsTo(Deal::class, 'deal_id');
    }

    public function sessions()
    {
        return $this->hasMany(DealSession::class, 'deal_gateway_id');
    }

    public function gateway()
    {
        return $this->morphTo();
    }

    public function dealLeads()
    {
        return $this->hasMany(DealLead::class, 'deal_gateway_id');
    }
}
