<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DealAdvertiserAgreementMeta extends Model
{

    use HasFactory;

    protected $guarded = [];

    public function dealAdvertiserAgreement()
    {
        return $this->belongsTo(DealAdvertiserAgreement::class);
    }

}
