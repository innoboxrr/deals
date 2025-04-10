<?php

namespace Innoboxrr\Deals\Models\Filters\DealAdvertiserAgreementInvoice;

use Illuminate\Database\Eloquent\Builder;
use Innoboxrr\SearchSurge\Search\Utils\Order;
use Innoboxrr\SearchSurge\Search\Support\DataContainer;

class EagerLoadingFilter
{
    public static function apply(Builder $query, DataContainer $data)
    {
        if ($data->load_advertiser_agreement == 1 || $data->load_advertiser_agreement === true) {
            $query->with(['advertiserAgreement']);
        }

        if ($data->load_advertiser == 1 || $data->load_advertiser === true) {
            $query->with(['advertiser']);
        }

        return $query;
    }
}
