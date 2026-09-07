<?php

namespace Innoboxrr\Deals\Database\Factories;

/*
 * Docs: https://fakerphp.github.io/ 
 */

use Innoboxrr\Deals\Models\DealAdvertiserAgreementCplAdjustment;
use Innoboxrr\Deals\Models\DealAdvertiserAgreement;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealAdvertiserAgreementCplAdjustmentFactory extends Factory
{

    protected $model = DealAdvertiserAgreementCplAdjustment::class;

    public function definition()
    {
        return [
            'before' => $this->faker->randomFloat(2, 5, 50),
            'after' => $this->faker->randomFloat(2, 5, 50),
            'deal_performance_snapshot_id' => $this->faker->uuid(),
            'deal_advertiser_agreement_id' => DealAdvertiserAgreement::factory(),
        ];
    }

}
