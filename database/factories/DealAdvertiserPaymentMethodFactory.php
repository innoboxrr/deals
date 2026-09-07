<?php

namespace Innoboxrr\Deals\Database\Factories;

/*
 * Docs: https://fakerphp.github.io/ 
 */

use Innoboxrr\Deals\Models\DealAdvertiserPaymentMethod;
use Innoboxrr\Deals\Models\DealAdvertiser;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealAdvertiserPaymentMethodFactory extends Factory
{

    protected $model = DealAdvertiserPaymentMethod::class;

    public function definition()
    {
        return [
            'processor' => $this->faker->randomElement(['stripe', 'paypal']),
            'processor_id' => $this->faker->uuid(),
            'status' => 'active',
            'deal_advertiser_id' => DealAdvertiser::factory(),
        ];
    }

}
