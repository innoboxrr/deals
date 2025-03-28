<?php

namespace Innoboxrr\Deals\Models\Filters\DealAdCampaign;

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

        if ($data->load_ad_platform == 1 || $data->load_ad_platform === true) {
            $query->with(['adPlatform']);
        }

        if ($data->load_ad_campaign_rules == 1 || $data->load_ad_campaign_rules === true) {
            $query->with(['adCampaignRules']);
        }

        if ($data->load_ad_groups == 1 || $data->load_ad_groups === true) {
            $query->with(['adGroups']);
        }

        if ($data->load_count_ad_campaign_rules == 1 || $data->load_count_ad_campaign_rules === true) {
            $query->withCount(['adCampaignRules']);
        }

        if ($data->load_count_ad_groups == 1 || $data->load_count_ad_groups === true) {
            $query->withCount(['adGroups']);
        }

        return $query;
    }
}