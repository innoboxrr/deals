<?php

namespace Innoboxrr\Deals\Models\Traits\Relations;

use Innoboxrr\Deals\Models\DealAdCampaignMeta;
use Innoboxrr\Deals\Models\DealAdPlatform;
use Innoboxrr\Deals\Models\DealAdCampaignRule;
use Innoboxrr\Deals\Models\DealAdGroup;
// use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait DealAdCampaignRelations
{
    public function metas()
    {
        return $this->hasMany(DealAdCampaignMeta::class, 'ad_campaign_id');
    }

    public function adPlatform()
    {
        return $this->belongsTo(DealAdPlatform::class, 'ad_platform_id');
    }

    public function adCampaignRules()
    {
        return $this->hasMany(DealAdCampaignRule::class, 'ad_campaign_id');
    }

    public function adGroups()
    {
        return $this->hasMany(DealAdGroup::class, 'ad_campaign_id');
    }
}