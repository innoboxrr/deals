<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DealAdvertiserAgreementConfigMeta extends Model
{

    use HasFactory;

    protected $guarded = [];

    public function dealAdvertiserAgreementConfig()
    {
        return $this->belongsTo(DealAdvertiserAgreementConfig::class);
    }

}
