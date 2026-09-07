<?php

namespace Innoboxrr\Deals\Database\Factories;

/*
 * Docs: https://fakerphp.github.io/ 
 */

use Innoboxrr\Deals\Models\DealAdPerformanceSnapshot;
use Innoboxrr\Deals\Models\DealAd;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealAdPerformanceSnapshotFactory extends Factory
{

    protected $model = DealAdPerformanceSnapshot::class;

    public function definition()
    {
        return [
            'from_date' => $this->faker->unixTime(),
            'to_date' => $this->faker->unixTime(),
            'deal_ad_id' => DealAd::factory(),
            'impressions' => $this->faker->numberBetween(0, 10000),
            'clicks' => $this->faker->numberBetween(0, 500),
            'leads' => $this->faker->numberBetween(0, 50),
            'spend' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }

}
