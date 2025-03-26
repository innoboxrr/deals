<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DealAdvertiserMeta extends Model
{

    use HasFactory;

    protected $guarded = [];

    public function dealAdvertiser()
    {
        return $this->belongsTo(DealAdvertiser::class);
    }

}
