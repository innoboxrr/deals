<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DealAdGroupMeta extends Model
{

    use HasFactory;

    protected $guarded = [];

    public function dealAdGroup()
    {
        return $this->belongsTo(DealAdGroup::class);
    }

}
