<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DealAdCampaignMeta extends Model
{

    use HasFactory;

    protected $guarded = [];

    public function dealAdCampaign()
    {
        return $this->belongsTo(DealAdCampaign::class);
    }

}
