<?php

namespace Innoboxrr\Deals\Models\Filters\DealAssignment;

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

        if ($data->load_advertiser_agreement == 1 || $data->load_advertiser_agreement === true) {
            $query->with(['advertiserAgreement']);
        }

        if ($data->load_router_execution == 1 || $data->load_router_execution === true) {
            $query->with(['routerExecution']);
        }

        return $query;
    }
}
