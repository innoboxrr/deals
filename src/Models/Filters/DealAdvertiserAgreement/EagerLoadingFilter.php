<?php

namespace Innoboxrr\Deals\Models\Filters\DealAdvertiserAgreement;

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

        if ($data->load_advertiser == 1 || $data->load_advertiser === true) {
            $query->with(['advertiser']);
        }

        if ($data->load_invoices == 1 || $data->load_invoices === true) {
            $query->with(['invoices']);
        }

        if ($data->load_constraints == 1 || $data->load_constraints === true) {
            $query->with(['constraints']);
        }

        if ($data->load_postbacks == 1 || $data->load_postbacks === true) {
            $query->with(['postbacks']);
        }

        if ($data->load_integrations == 1 || $data->load_integrations === true) {
            $query->with(['integrations']);
        }

        if ($data->load_configs == 1 || $data->load_configs === true) {
            $query->with(['configs']);
        }

        if ($data->load_dailies == 1 || $data->load_dailies === true) {
            $query->with(['dailies']);
        }

        if ($data->load_cpl_adjustments == 1 || $data->load_cpl_adjustments === true) {
            $query->with(['cplAdjustments']);
        }

        if ($data->load_count_invoices == 1 || $data->load_count_invoices === true) {
            $query->withCount(['invoices']);
        }

        if ($data->load_count_constraints == 1 || $data->load_count_constraints === true) {
            $query->withCount(['constraints']);
        }

        if ($data->load_count_postbacks == 1 || $data->load_count_postbacks === true) {
            $query->withCount(['postbacks']);
        }

        if ($data->load_count_integrations == 1 || $data->load_count_integrations === true) {
            $query->withCount(['integrations']);
        }

        if ($data->load_count_configs == 1 || $data->load_count_configs === true) {
            $query->withCount(['configs']);
        }

        if ($data->load_count_dailies == 1 || $data->load_count_dailies === true) {
            $query->withCount(['dailies']);
        }

        if ($data->load_count_cpl_adjustments == 1 || $data->load_count_cpl_adjustments === true) {
            $query->withCount(['cplAdjustments']);
        }

        return $query;
    }
}
