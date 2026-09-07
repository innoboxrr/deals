<?php

namespace Innoboxrr\Deals\Database\Factories;

/*
 * Docs: https://fakerphp.github.io/ 
 */

use Innoboxrr\Deals\Models\DealGateway;
use Innoboxrr\Deals\Models\Deal;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealGatewayFactory extends Factory
{

    protected $model = DealGateway::class;

    public function definition()
    {
        return [
            'deal_id' => Deal::factory(),
            'gateway_type' => 'App\\Models\\Endpoint',
            'gateway_id' => $this->faker->randomNumber(3),
            'status' => 'active',
        ];
    }

}
