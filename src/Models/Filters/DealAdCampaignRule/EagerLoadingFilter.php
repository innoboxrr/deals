<?php

namespace Innoboxrr\Deals\Models\Filters\DealAdCampaignRule;

use Illuminate\Database\Eloquent\Builder;
use Innoboxrr\SearchSurge\Search\Utils\Order;
use Innoboxrr\SearchSurge\Search\Support\DataContainer;

class EagerLoadingFilter
{

    public static function apply(Builder $query, DataContainer $data)
    {
        if ($data->load_ad_campaign == 1 || $data->load_ad_campaign == true) {
            $query->with(['adCampaign']);
        }

        /*
        if ($data->load_relation == 1 || $data->load_relation == true) {
            $query->with(['relation']);
        }
        */

        return $query;

    }

}
