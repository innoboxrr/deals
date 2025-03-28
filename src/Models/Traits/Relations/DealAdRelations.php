<?php

namespace Innoboxrr\Deals\Models\Traits\Relations;

use Innoboxrr\Deals\Models\DealAdGroup;
use Innoboxrr\Deals\Models\DealAdPerformanceSnapshot;
use Innoboxrr\Deals\Models\DealAdMeta;

// use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait DealAdRelations
{
    public function metas()
    {
        return $this->hasMany(DealAdMeta::class, 'ad_id');
    }

    public function adGroup()
    {
        return $this->belongsTo(DealAdGroup::class, 'deal_ad_group_id');
    }

    public function performanceSnapshots()
    {
        return $this->hasMany(DealAdPerformanceSnapshot::class, 'deal_ad_id');
    }
}
