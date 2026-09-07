<?php

namespace Innoboxrr\Deals\Database\Factories;

/*
 * Docs: https://fakerphp.github.io/ 
 */

use Innoboxrr\Deals\Models\DealSessionEvent;
use Innoboxrr\Deals\Models\DealSession;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealSessionEventFactory extends Factory
{

    protected $model = DealSessionEvent::class;

    public function definition()
    {
        return [
            'key' => $this->faker->randomElement(['viewed', 'clicked', 'scrolled', 'form_submitted']),
            'value' => $this->faker->word(),
            'deal_session_id' => DealSession::factory(),
        ];
    }

}
