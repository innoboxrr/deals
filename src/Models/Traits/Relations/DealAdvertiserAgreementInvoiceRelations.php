<?php

namespace Innoboxrr\Deals\Models\Traits\Relations;

use Innoboxrr\Deals\Models\DealAdvertiserAgreement;
use Innoboxrr\Deals\Models\DealAdvertiser;

// use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait DealAdvertiserAgreementInvoiceRelations
{
    public function advertiserAgreement()
    {
        return $this->belongsTo(DealAdvertiserAgreement::class, 'deal_advertiser_agreement_id');
    }

    public function advertiser()
    {
        return $this->belongsTo(DealAdvertiser::class, 'deal_advertiser_id');
    }
}
