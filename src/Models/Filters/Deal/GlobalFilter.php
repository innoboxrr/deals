<?php

namespace Innoboxrr\Deals\Models\Filters\Deal;

use Illuminate\Database\Eloquent\Builder;
use Innoboxrr\SearchSurge\Search\Utils\Order;
use Innoboxrr\SearchSurge\Search\Support\DataContainer;

class GlobalFilter
{
    public static function apply(Builder $query, DataContainer $data)
    {
        if ($data->global) {
            $query->where(function ($query) use ($data) {
                $query->where('name', 'like', '%' . $data->global . '%')
                    ->orWhere('description', 'like', '%' . $data->global . '%');
            });
        }
        return $query;
    }
}
