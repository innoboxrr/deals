<?php

namespace Innoboxrr\Deals\Models\Traits\Relations;

use Innoboxrr\Deals\Models\DealRouter;
use Innoboxrr\Deals\Models\DealAssignment;
// use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait DealRouterExecutionRelations
{
    public function router()
    {
        return $this->belongsTo(DealRouter::class, 'deal_router_id');
    }

    public function assignments()
    {
        return $this->hasMany(DealAssignment::class, 'deal_router_execution_id');
    }
}
