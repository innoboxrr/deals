<?php

namespace Innoboxrr\Deals\Models\Traits\Relations;

use Innoboxrr\Deals\Models\Deal;
use Innoboxrr\Deals\Models\DealAdPlatformMeta;
use Innoboxrr\Deals\Models\DealAdCampaign;

// use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait DealAdPlatformRelations
{
    public function metas()
    {
        return $this->hasMany(DealAdPlatformMeta::class, 'ad_platform_id');
    }

    public function deal()
    {
        return $this->belongsTo(Deal::class, 'deal_id');
    }

    public function adCampaigns()
    {
        return $this->hasMany(DealAdCampaign::class, 'deal_ad_platform_id');
    }
}
