<?php

namespace Innoboxrr\Deals\Models\Traits\Relations;

use Innoboxrr\Deals\Models\Deal;
use Innoboxrr\Deals\Models\DealRouterExecution;
// use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait DealRouterRelations
{
    public function deal()
    {
        return $this->belongsTo(Deal::class, 'deal_id');
    }

    public function executions()
    {
        return $this->hasMany(DealRouterExecution::class, 'deal_router_id');
    }
}
