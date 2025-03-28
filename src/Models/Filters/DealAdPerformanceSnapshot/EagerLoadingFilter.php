<?php

namespace Innoboxrr\Deals\Models\Filters\DealAdPerformanceSnapshot;

use Illuminate\Database\Eloquent\Builder;
use Innoboxrr\SearchSurge\Search\Utils\Order;
use Innoboxrr\SearchSurge\Search\Support\DataContainer;

class EagerLoadingFilter
{

    public static function apply(Builder $query, DataContainer $data)
    {
        if ($data->load_ad == 1 || $data->load_ad == true) {
            $query->with(['ad']);
        }
        /*
        if ($data->load_relation == 1 || $data->load_relation == true) {
            $query->with(['relation']);
        }
        */

        return $query;

    }

}
