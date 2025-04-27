<?php

namespace Innoboxrr\Deals\Support\Traits;

use Innoboxrr\Deals\Models\DealLead;
use Innoboxrr\Deals\Models\Deal;

trait DealLeadTrait
{
    public function dealLeads()
    {
        return $this->hasMany(DealLead::class, 'lead_id');
    }

    public function deal()
    {
        return $this->belongsTo(Deal::class, 'deal_id');
    }
}