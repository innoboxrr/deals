<?php

namespace Innoboxrr\Deals\Models\Traits\Relations;

use Innoboxrr\Deals\Models\DealAdvertiserMeta;
use Innoboxrr\Deals\Models\DealAdvertiserAgreement;
use Innoboxrr\Deals\Models\DealAdvertiserPaymentMethod;
// use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait DealAdvertiserRelations
{
    public function metas()
    {
        return $this->hasMany(DealAdvertiserMeta::class, 'deal_advertiser_id');
    }

    // If there's an Agent model:
    // public function agent()
    // {
    //     return $this->belongsTo(Agent::class, 'agent_id');
    // }

    public function agreements()
    {
        return $this->hasMany(DealAdvertiserAgreement::class, 'deal_advertiser_id');
    }

    public function paymentMethods()
    {
        return $this->hasMany(DealAdvertiserPaymentMethod::class, 'deal_advertiser_id');
    }
}
