<?php

namespace Innoboxrr\Deals\Models\Filters\Deal;

use Illuminate\Database\Eloquent\Builder;
use Innoboxrr\SearchSurge\Search\Utils\Order;
use Innoboxrr\SearchSurge\Search\Support\DataContainer;

class EagerLoadingFilter
{

    public static function apply(Builder $query, DataContainer $data)
    {
        if ($data->load_ad_platforms == 1 || $data->load_ad_platforms == true) {
            $query->with(['adPlatforms']);
        }

        if ($data->load_advertiser == 1 || $data->load_advertiser == true) {
            $query->with(['advertiser']);
        }

        // if ($data->load_affiliate_agreements == 1 || $data->load_affiliate_agreements == true) {
        //     $query->with(['affiliateAgreements']);
        // }

        // if ($data->load_affiliate_invoices == 1 || $data->load_affiliate_invoices == true) {
        //     $query->with(['affiliateInvoices']);
        // }

        if ($data->load_alerts == 1 || $data->load_alerts == true) {
            $query->with(['alerts']);
        }

        if ($data->load_gateways == 1 || $data->load_gateways == true) {
            $query->with(['gateways']);
        }

        if ($data->load_performance_snapshots == 1 || $data->load_performance_snapshots == true) {
            $query->with(['performanceSnapshots']);
        }

        if ($data->load_product == 1 || $data->load_product == true) {
            $query->with(['product']);
        }

        if ($data->load_metas == 1 || $data->load_metas == true) {
            $query->with(['metas']);
        }

        if ($data->load_router == 1 || $data->load_router == true) {
            $query->with(['router']);
        }

        return $query;
    }

}
