<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DealAdPlatformMeta extends Model
{

    use HasFactory;

    protected $guarded = [];

    public function dealAdPlatform()
    {
        return $this->belongsTo(DealAdPlatform::class);
    }

}
