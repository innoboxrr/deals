<?php

namespace Innoboxrr\Deals\Models\Filters\DealAd;

use Illuminate\Database\Eloquent\Builder;
use Innoboxrr\SearchSurge\Search\Utils\Order;
use Innoboxrr\SearchSurge\Search\Support\DataContainer;

class EagerLoadingFilter
{

    public static function apply(Builder $query, DataContainer $data)
    {
        if ($data->load_metas == 1 || $data->load_metas === true) {
            $query->with(['metas']);
        }

        if ($data->load_ad_group == 1 || $data->load_ad_group === true) {
            $query->with(['adGroup']);
        }

        if ($data->load_performance_snapshots == 1 || $data->load_performance_snapshots === true) {
            $query->with(['performanceSnapshots']);
        }

        return $query;
    }

}
