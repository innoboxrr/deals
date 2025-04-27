<?php

namespace Innoboxrr\Deals\Support\Traits;

use Innoboxrr\Deals\Models\DealGateway as DealGatewayModel;
use Illuminate\Support\Facades\Cache;

trait DealGatewayTrait
{
    public function getGatewayDeal()
    {
        $cacheKey = 'gateway_deal:' . static::class . ':' . $this->id;

        return Cache::remember($cacheKey, 3600, function () {
            $dealGateway = DealGatewayModel::where('gateway_type', static::class)
                ->where('gateway_id', $this->id)
                ->first();
            return $dealGateway ? $dealGateway->deal : null;
        });
    }

    public function getDealGateway()
    {
        $cacheKey = 'deal_gateway:' . static::class . ':' . $this->id;

        return Cache::remember($cacheKey, 3600, function () {
            return DealGatewayModel::where('gateway_type', static::class)
                ->where('gateway_id', $this->id)
                ->first();
        });
    }
}
