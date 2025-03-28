<?php

namespace Innoboxrr\Deals\Models\Filters\DealLeadTrackingEvent;

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

        if ($data->load_pixel_fires == 1 || $data->load_pixel_fires === true) {
            $query->with(['pixelFires']);
        }

        if ($data->load_count_pixel_fires == 1 || $data->load_count_pixel_fires === true) {
            $query->withCount(['pixelFires']);
        }

        return $query;
    }
}
