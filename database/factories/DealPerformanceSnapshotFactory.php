<?php

namespace Innoboxrr\Deals\Database\Factories;

/*
 * Docs: https://fakerphp.github.io/ 
 */

use Innoboxrr\Deals\Models\DealPerformanceSnapshot;
use Innoboxrr\Deals\Models\Deal;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealPerformanceSnapshotFactory extends Factory
{

    protected $model = DealPerformanceSnapshot::class;

    public function definition()
    {
        return [
            'time' => $this->faker->unixTime(),
            'deal_id' => Deal::factory(),
            'leads_generated' => $this->faker->numberBetween(0, 100),
            'leads_assigned' => $this->faker->numberBetween(0, 50),
        ];
    }

}
