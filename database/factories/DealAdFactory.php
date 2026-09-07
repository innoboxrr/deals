<?php

namespace Innoboxrr\Deals\Database\Factories;

/*
 * Docs: https://fakerphp.github.io/ 
 */

use Innoboxrr\Deals\Models\DealAd;
use Innoboxrr\Deals\Models\DealAdGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealAdFactory extends Factory
{

    protected $model = DealAd::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'deal_ad_group_id' => DealAdGroup::factory(),
        ];
    }

}
