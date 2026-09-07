<?php

namespace Innoboxrr\Deals\Database\Factories;

/*
 * Docs: https://fakerphp.github.io/ 
 */

use Innoboxrr\Deals\Models\DealSession;
use Innoboxrr\Deals\Models\DealGateway;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealSessionFactory extends Factory
{

    protected $model = DealSession::class;

    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid(),
            'deal_gateway_id' => DealGateway::factory(),
        ];
    }

}
