<?php

namespace Innoboxrr\Deals\Database\Factories;

/*
 * Docs: https://fakerphp.github.io/ 
 */

use Innoboxrr\Deals\Models\DealPixelFire;
use Innoboxrr\Deals\Models\DealLeadTrackingEvent;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealPixelFireFactory extends Factory
{

    protected $model = DealPixelFire::class;

    public function definition()
    {
        return [
            'fired_at' => $this->faker->dateTimeThisMonth(),
            'platform_type' => $this->faker->randomElement(['facebook', 'google', 'tiktok']),
            'platform_id' => $this->faker->uuid(),
            'deal_lead_tracking_event_id' => DealLeadTrackingEvent::factory(),
        ];
    }

}
