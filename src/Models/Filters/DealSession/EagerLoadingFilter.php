<?php

namespace Innoboxrr\Deals\Models\Filters\DealSession;

use Illuminate\Database\Eloquent\Builder;
use Innoboxrr\SearchSurge\Search\Utils\Order;
use Innoboxrr\SearchSurge\Search\Support\DataContainer;

class EagerLoadingFilter
{
    public static function apply(Builder $query, DataContainer $data)
    {
        if ($data->load_lead == 1 || $data->load_lead === true) {
            $query->with(['lead']);
        }

        if ($data->load_gateway == 1 || $data->load_gateway === true) {
            $query->with(['gateway']);
        }

        if ($data->load_events == 1 || $data->load_events === true) {
            $query->with(['events']);
        }

        if ($data->load_count_events == 1 || $data->load_count_events === true) {
            $query->withCount(['events']);
        }

        return $query;
    }
}
