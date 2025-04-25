<?php

namespace Innoboxrr\Deals\Models\Filters\DealAdvertiserAgreement;

use Illuminate\Database\Eloquent\Builder;
use Innoboxrr\SearchSurge\Search\Utils\Order;
use Innoboxrr\SearchSurge\Search\Support\DataContainer;

class DealFilter
{
    public static function apply(Builder $query, DataContainer $data)
    {
        if ($data->deal_id) {
            $query->where('deal_id', $data->deal_id);
        }
        $query = Order::orderBy($query, $data, 'deal_id');
        return $query;
    }
}
