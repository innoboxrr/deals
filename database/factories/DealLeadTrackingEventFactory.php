<?php

namespace Innoboxrr\Deals\Database\Factories;

/*
 * Docs: https://fakerphp.github.io/ 
 */

use Innoboxrr\Deals\Models\DealLeadTrackingEvent;
use Innoboxrr\Deals\Models\DealLead;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealLeadTrackingEventFactory extends Factory
{

    protected $model = DealLeadTrackingEvent::class;

    public function definition()
    {
        return [
            'event' => $this->faker->randomElement(['click', 'open', 'delivered', 'bounce', 'spam']),
            'deal_lead_id' => DealLead::factory(),
        ];
    }

}
