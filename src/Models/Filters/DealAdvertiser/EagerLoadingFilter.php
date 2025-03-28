<?php

namespace Innoboxrr\Deals\Models\Filters\DealAdvertiser;

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

        if ($data->load_deal == 1 || $data->load_deal === true) {
            $query->with(['deal']);
        }

        if ($data->load_agreements == 1 || $data->load_agreements === true) {
            $query->with(['agreements']);
        }

        if ($data->load_payment_methods == 1 || $data->load_payment_methods === true) {
            $query->with(['paymentMethods']);
        }

        if ($data->load_count_agreements == 1 || $data->load_count_agreements === true) {
            $query->withCount(['agreements']);
        }

        if ($data->load_count_payment_methods == 1 || $data->load_count_payment_methods === true) {
            $query->withCount(['paymentMethods']);
        }

        // if ($data->load_agent == 1 || $data->load_agent === true) {
        //     $query->with(['agent']);
        // }

        return $query;
    }
}
