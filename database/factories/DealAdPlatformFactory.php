<?php

namespace Innoboxrr\Deals\Database\Factories;

/*
 * Docs: https://fakerphp.github.io/ 
 */

use Innoboxrr\Deals\Models\DealAdPlatform;
use Innoboxrr\Deals\Models\Deal;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealAdPlatformFactory extends Factory
{

    protected $model = DealAdPlatform::class;

    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Google Ads', 'Facebook Ads', 'TikTok Ads', 'LinkedIn Ads']),
            'deal_id' => Deal::factory(),
        ];
    }

}
