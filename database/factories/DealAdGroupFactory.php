<?php

namespace Innoboxrr\Deals\Database\Factories;

/*
 * Docs: https://fakerphp.github.io/ 
 */

use Innoboxrr\Deals\Models\DealAdGroup;
use Innoboxrr\Deals\Models\DealAdCampaign;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealAdGroupFactory extends Factory
{

    protected $model = DealAdGroup::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'deal_ad_campaign_id' => DealAdCampaign::factory(),
        ];
    }

}
