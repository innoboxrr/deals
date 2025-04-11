<?php

namespace Innoboxrr\Deals\Models\Traits\Relations;

use Innoboxrr\Deals\Models\DealAdPlatform;
// use Innoboxrr\Deals\Models\DealAffiliateAgreement;
// use Innoboxrr\Deals\Models\DealAffiliateInvoice;
use Innoboxrr\Deals\Models\DealAlert;
use Innoboxrr\Deals\Models\DealGateway;
use Innoboxrr\Deals\Models\DealPerformanceSnapshot;
use Innoboxrr\Deals\Models\DealProduct;
use Innoboxrr\Deals\Models\DealMeta;
use Innoboxrr\Deals\Models\DealRouter;
use Innoboxrr\Deals\Models\DealAdvertiserAgreement;

// use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait DealRelations
{
    public function metas()
    {
        return $this->hasMany(DealMeta::class, 'deal_id');
    }

    public function product()
    {
        return $this->hasOne(DealProduct::class, 'deal_id');
    }

    //////
    //////
    //////

    public function adPlatforms()
    {
        return $this->hasMany(DealAdPlatform::class, 'deal_id');
    }

    /*

    public function affiliateAgreements()
    {
        return $this->hasMany(DealAffiliateAgreement::class, 'deal_id');
    }

    public function affiliateInvoices()
    {
        return $this->hasMany(DealAffiliateInvoice::class, 'deal_id');
    }

    */

    public function alerts()
    {
        return $this->hasMany(DealAlert::class, 'deal_id');
    }

    public function gateways()
    {
        return $this->hasMany(DealGateway::class, 'deal_id');
    }

    public function performanceSnapshots()
    {
        return $this->hasMany(DealPerformanceSnapshot::class, 'deal_id');
    }

    public function router()
    {
        return $this->hasOne(DealRouter::class, 'deal_id');
    }

    public function dealAdvertiserAgreements()
    {
        return $this->hasMany(DealAdvertiserAgreement::class, 'deal_id');
    }
}
