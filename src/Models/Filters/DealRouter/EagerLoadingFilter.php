<?php

namespace Innoboxrr\Deals\Models\Filters\DealRouter;

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

        if ($data->load_executions == 1 || $data->load_executions === true) {
            $query->with(['executions']);
        }

        if ($data->load_count_executions == 1 || $data->load_count_executions === true) {
            $query->withCount(['executions']);
        }

        return $query;
    }
}
