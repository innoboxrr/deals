<?php

namespace Innoboxrr\Deals\Models\Filters\DealGateway;

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

        if ($data->load_sessions == 1 || $data->load_sessions === true) {
            $query->with(['sessions']);
        }

        if ($data->load_count_sessions == 1 || $data->load_count_sessions === true) {
            $query->withCount(['sessions']);
        }

        return $query;
    }
}
