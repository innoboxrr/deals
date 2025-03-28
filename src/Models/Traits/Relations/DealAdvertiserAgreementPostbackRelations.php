<?php

namespace Innoboxrr\Deals\Models\Traits\Relations;

use Innoboxrr\Deals\Models\DealAdvertiserAgreement;
use Innoboxrr\Deals\Models\DealLead;

// use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait DealAdvertiserAgreementPostbackRelations
{
    public function advertiserAgreement()
    {
        return $this->belongsTo(DealAdvertiserAgreement::class, 'deal_advertiser_agreement_id');
    }

    public function lead()
    {
        return $this->belongsTo(DealLead::class, 'deal_lead_id');
    }
}
