<?php

namespace Innoboxrr\Deals\Models\Filters\DealRouterExecution;

use Illuminate\Database\Eloquent\Builder;
use Innoboxrr\SearchSurge\Search\Utils\Order;
use Innoboxrr\SearchSurge\Search\Support\DataContainer;

class EagerLoadingFilter
{
    public static function apply(Builder $query, DataContainer $data)
    {
        if ($data->load_router == 1 || $data->load_router === true) {
            $query->with(['router']);
        }

        if ($data->load_assignments == 1 || $data->load_assignments === true) {
            $query->with(['assignments']);
        }

        if ($data->load_count_assignments == 1 || $data->load_count_assignments === true) {
            $query->withCount(['assignments']);
        }

        return $query;
    }
}
