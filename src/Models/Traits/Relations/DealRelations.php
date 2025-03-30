<?php

namespace Innoboxrr\Deals\Models\Traits\Relations;

use Innoboxrr\Deals\Models\DealAdPlatform;
use Innoboxrr\Deals\Models\DealAdvertiser;
// use Innoboxrr\Deals\Models\DealAffiliateAgreement;
// use Innoboxrr\Deals\Models\DealAffiliateInvoice;
use Innoboxrr\Deals\Models\DealAlert;
use Innoboxrr\Deals\Models\DealGateway;
use Innoboxrr\Deals\Models\DealPerformanceSnapshot;
use Innoboxrr\Deals\Models\DealProduct;
use Innoboxrr\Deals\Models\DealProductMeta;
use Innoboxrr\Deals\Models\DealRouter;
use Innoboxrr\Deals\Models\DealAdvertiserAgreement;
// use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait DealRelations
{
    public function adPlatforms()
    {
        return $this->hasMany(DealAdPlatform::class, 'deal_id');
    }

    public function advertiser()
    {
        return $this->hasOne(DealAdvertiser::class, 'deal_id');
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

    public function product()
    {
        return $this->belongsTo(DealProduct::class, 'deal_product_id');
    }

    public function metas()
    {
        return $this->hasMany(DealProductMeta::class, 'deal_id');
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
