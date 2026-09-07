<?php

namespace Innoboxrr\Deals\Database\Factories;

/*
 * Docs: https://fakerphp.github.io/ 
 */

use Innoboxrr\Deals\Models\DealAlert;
use Innoboxrr\Deals\Models\Deal;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealAlertFactory extends Factory
{

    protected $model = DealAlert::class;

    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['high_cpl', 'low_cpl', 'leads_stuck', 'sla_breach']),
            'message' => $this->faker->sentence(),
            'detected_at' => $this->faker->dateTimeThisMonth(),
            'status' => 'unresolved',
            'deal_id' => Deal::factory(),
        ];
    }

}
