<?php

namespace Innoboxrr\Deals\Database\Factories;

/*
 * Docs: https://fakerphp.github.io/ 
 */

use Innoboxrr\Deals\Models\DealAdCampaignRule;
use Innoboxrr\Deals\Models\DealAdCampaign;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealAdCampaignRuleFactory extends Factory
{

    protected $model = DealAdCampaignRule::class;

    public function definition()
    {
        return [
            'condition_type' => $this->faker->randomElement(['cost_per_lead_greater_than', 'cost_per_lead_less_than', 'conversion_rate_greater_than']),
            'value' => (string) $this->faker->randomFloat(2, 10, 1000),
            'action' => $this->faker->randomElement(['pause', 'resume', 'notify', 'notify_and_pause']),
            'deal_ad_campaign_id' => DealAdCampaign::factory(),
        ];
    }

}
