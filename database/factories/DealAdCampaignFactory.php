<?php

namespace Innoboxrr\Deals\Database\Factories;

/*
 * Docs: https://fakerphp.github.io/ 
 */

use Innoboxrr\Deals\Models\DealAdCampaign;
use Innoboxrr\Deals\Models\DealAdPlatform;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealAdCampaignFactory extends Factory
{

    protected $model = DealAdCampaign::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'deal_ad_platform_id' => DealAdPlatform::factory(),
        ];
    }

}
