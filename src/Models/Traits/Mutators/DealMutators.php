<?php

namespace Innoboxrr\Deals\Models\Traits\Mutators;

trait DealMutators
{
    public function getQueueAttribute()
    {
        return $this->getPayload('queue', 'default');
    }

    public function getDailySpentProgressAttribute()
    {
        $dailyBudget = $this->getPayload('last_performance_snapshot.daily_budget');
        $dailySpent = $this->getPayload('last_performance_snapshot.daily_spent');

        return $dailyBudget > 0 ? ($dailySpent / $dailyBudget) * 100 : 0;
    }
}