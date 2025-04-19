<?php

namespace Innoboxrr\Deals\Models\Traits\Relations;

use Innoboxrr\Deals\Models\DealAdvertiser;
use Innoboxrr\Deals\Models\DealAdvertiserAgreementMeta;
use Innoboxrr\Deals\Models\DealAdvertiserAgreementInvoice;
use Innoboxrr\Deals\Models\DealAdvertiserAgreementPostback;
use Innoboxrr\Deals\Models\DealAdvertiserAgreementIntegration;
use Innoboxrr\Deals\Models\DealAdvertiserAgreementConfig;
use Innoboxrr\Deals\Models\DealAdvertiserAgreementDaily;
use Innoboxrr\Deals\Models\DealAdvertiserAgreementCplAdjustment;
use Innoboxrr\Deals\Models\Deal;

// use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait DealAdvertiserAgreementRelations
{
    public function metas()
    {
        return $this->hasMany(DealAdvertiserAgreementMeta::class, 'deal_advertiser_agreement_id');
    }

    public function advertiser()
    {
        return $this->belongsTo(DealAdvertiser::class, 'deal_advertiser_id');
    }

    public function invoices()
    {
        return $this->hasMany(DealAdvertiserAgreementInvoice::class, 'deal_advertiser_agreement_id');
    }

    public function postbacks()
    {
        return $this->hasMany(DealAdvertiserAgreementPostback::class, 'deal_advertiser_agreement_id');
    }

    public function integrations()
    {
        return $this->hasMany(DealAdvertiserAgreementIntegration::class, 'deal_advertiser_agreement_id');
    }

    public function configs()
    {
        return $this->hasMany(DealAdvertiserAgreementConfig::class, 'deal_advertiser_agreement_id');
    }

    public function dailies()
    {
        return $this->hasMany(DealAdvertiserAgreementDaily::class, 'deal_advertiser_agreement_id');
    }

    public function cplAdjustments()
    {
        return $this->hasMany(DealAdvertiserAgreementCplAdjustment::class, 'deal_advertiser_agreement_id');
    }

    public function deal()
    {
        return $this->belongsTo(Deal::class, 'deal_id');
    }
}
