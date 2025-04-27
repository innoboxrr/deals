<?php

namespace Innoboxrr\Deals\Models\Traits\Scopes;

trait DealLeadScopes
{
    public function scopeLight($query)
    {
        return $query->select([
            'id',
            'status',
            'lead_id',
            'deal_gateway_id',
            'created_at',
            'updated_at',
        ]);
    }
}