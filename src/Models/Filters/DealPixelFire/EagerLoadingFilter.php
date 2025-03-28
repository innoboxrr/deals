<?php

namespace Innoboxrr\Deals\Models\Filters\DealPixelFire;

use Illuminate\Database\Eloquent\Builder;
use Innoboxrr\SearchSurge\Search\Utils\Order;
use Innoboxrr\SearchSurge\Search\Support\DataContainer;

class EagerLoadingFilter
{
    public static function apply(Builder $query, DataContainer $data)
    {
        if ($data->load_tracking_event == 1 || $data->load_tracking_event === true) {
            $query->with(['trackingEvent']);
        }

        if ($data->load_ad_platform == 1 || $data->load_ad_platform === true) {
            $query->with(['adPlatform']);
        }

        // if ($data->load_affiliate == 1 || $data->load_affiliate === true) {
        //     $query->with(['affiliate']);
        // }

        return $query;
    }
}
