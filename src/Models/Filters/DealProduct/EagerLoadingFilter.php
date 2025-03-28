<?php

namespace Innoboxrr\Deals\Models\Filters\DealProduct;

use Illuminate\Database\Eloquent\Builder;
use Innoboxrr\SearchSurge\Search\Utils\Order;
use Innoboxrr\SearchSurge\Search\Support\DataContainer;

class EagerLoadingFilter
{
    public static function apply(Builder $query, DataContainer $data)
    {
        if ($data->load_deal == 1 || $data->load_deal === true) {
            $query->with(['deal']);
        }

        if ($data->load_metas == 1 || $data->load_metas === true) {
            $query->with(['metas']);
        }

        if ($data->load_count_metas == 1 || $data->load_count_metas === true) {
            $query->withCount(['metas']);
        }

        return $query;
    }
}
