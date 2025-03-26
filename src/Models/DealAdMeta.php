<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DealAdMeta extends Model
{

    use HasFactory;

    protected $guarded = [];

    public function dealAd()
    {
        return $this->belongsTo(DealAd::class);
    }

}
