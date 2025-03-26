<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DealProductMeta extends Model
{

    use HasFactory;

    protected $guarded = [];

    public function dealProduct()
    {
        return $this->belongsTo(DealProduct::class);
    }

}
