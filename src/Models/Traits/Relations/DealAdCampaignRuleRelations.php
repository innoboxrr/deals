<?php

namespace Innoboxrr\Deals\Models\Traits\Relations;

use Innoboxrr\Deals\Models\DealAdCampaign;

// use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait DealAdCampaignRuleRelations
{
    public function adCampaign()
    {
        return $this->belongsTo(DealAdCampaign::class, 'deal_ad_campaign_id');
    }
}
