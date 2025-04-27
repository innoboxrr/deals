<?php

namespace Innoboxrr\Deals\Models\Traits\Scopes;

use Innoboxrr\Deals\Enums\Deal\Status;

trait DealScopes
{
    public function scopeActive($query)
    {
        return $query->where('status', Status::ACTIVE->value);
    }
}