<?php

namespace Innoboxrr\Deals\Models\Filters\DealLead;

use Illuminate\Database\Eloquent\Builder;
use Innoboxrr\SearchSurge\Search\Utils\Order;
use Innoboxrr\SearchSurge\Search\Support\DataContainer;

class EagerLoadingFilter
{
    public static function apply(Builder $query, DataContainer $data)
    {
        if ($data->load_deal_gateway == 1 || $data->load_deal_gateway === true) {
            $query->with(['dealGateway']);
        }

        if ($data->load_sessions == 1 || $data->load_sessions === true) {
            $query->with(['sessions']);
        }

        if ($data->load_postbacks == 1 || $data->load_postbacks === true) {
            $query->with(['postbacks']);
        }

        if ($data->load_tracking_events == 1 || $data->load_tracking_events === true) {
            $query->with(['trackingEvents']);
        }

        if ($data->load_count_sessions == 1 || $data->load_count_sessions === true) {
            $query->withCount(['sessions']);
        }

        if ($data->load_count_postbacks == 1 || $data->load_count_postbacks === true) {
            $query->withCount(['postbacks']);
        }

        if ($data->load_count_tracking_events == 1 || $data->load_count_tracking_events === true) {
            $query->withCount(['trackingEvents']);
        }

        return $query;
    }
}
