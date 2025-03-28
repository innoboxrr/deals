<?php

namespace Innoboxrr\Deals\Models\Traits\Relations;

use Innoboxrr\Deals\Models\DealLead;
use Innoboxrr\Deals\Models\DealAdvertiserAgreement;
use Innoboxrr\Deals\Models\DealRouterExecution;

// use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait DealAssignmentRelations
{
    public function lead()
    {
        return $this->belongsTo(DealLead::class, 'deal_lead_id');
    }

    public function advertiserAgreement()
    {
        return $this->belongsTo(DealAdvertiserAgreement::class, 'deal_advertiser_agreement_id');
    }

    public function routerExecution()
    {
        return $this->belongsTo(DealRouterExecution::class, 'deal_router_execution_id');
    }
}
