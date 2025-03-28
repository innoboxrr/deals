<?php

namespace Innoboxrr\Deals\Models\Traits\Relations;

use Innoboxrr\Deals\Models\DealAdvertiserAgreement;
use Innoboxrr\Deals\Models\DealAdvertiserAgreementConfigMeta;

// use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait DealAdvertiserAgreementConfigRelations
{
    public function metas()
    {
        return $this->hasMany(DealAdvertiserAgreementConfigMeta::class, 'deal_advertiser_agreement_config_id');
    }

    public function advertiserAgreement()
    {
        return $this->belongsTo(DealAdvertiserAgreement::class, 'deal_advertiser_agreement_id');
    }
}
