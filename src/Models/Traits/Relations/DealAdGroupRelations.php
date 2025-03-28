<?php

namespace Innoboxrr\Deals\Models\Traits\Relations;

use Innoboxrr\Deals\Models\DealAdCampaign;
use Innoboxrr\Deals\Models\DealAd;
use Innoboxrr\Deals\Models\DealAdGroupMeta;

// use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait DealAdGroupRelations
{
    public function metas()
    {
        return $this->hasMany(DealAdGroupMeta::class, 'ad_group_id');
    }

    public function adCampaign()
    {
        return $this->belongsTo(DealAdCampaign::class, 'deal_ad_campaign_id');
    }

    public function ads()
    {
        return $this->hasMany(DealAd::class, 'deal_ad_group_id');
    }
}
