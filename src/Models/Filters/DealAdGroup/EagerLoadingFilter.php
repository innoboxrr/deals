<?php

namespace Innoboxrr\Deals\Models\Filters\DealAdGroup;

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

        if ($data->load_ad_campaign == 1 || $data->load_ad_campaign === true) {
            $query->with(['adCampaign']);
        }

        if ($data->load_ads == 1 || $data->load_ads === true) {
            $query->with(['ads']);
        }

        if ($data->load_count_ads == 1 || $data->load_count_ads === true) {
            $query->withCount(['ads']);
        }

        return $query;
    }
}
