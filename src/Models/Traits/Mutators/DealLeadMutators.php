<?php

namespace Innoboxrr\Deals\Models\Traits\Mutators;

trait DealLeadMutators
{

    public function getAgeAttribute()
    {
        return floor($this->lead->dob?->diffInYears(now()) ?? 0);
    }

}