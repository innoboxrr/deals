<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DealMeta extends Model
{

    use HasFactory;

    protected $guarded = [];

    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }

}
