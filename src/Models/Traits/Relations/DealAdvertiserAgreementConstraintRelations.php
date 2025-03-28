<?php

namespace Innoboxrr\Deals\Models\Traits\Relations;

use Innoboxrr\Deals\Models\DealAdvertiserAgreement;

// use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait DealAdvertiserAgreementConstraintRelations
{
    public function advertiserAgreement()
    {
        return $this->belongsTo(DealAdvertiserAgreement::class, 'deal_advertiser_agreement_id');
    }
}
