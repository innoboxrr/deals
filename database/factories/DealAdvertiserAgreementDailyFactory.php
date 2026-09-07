<?php

namespace Innoboxrr\Deals\Database\Factories;

/*
 * Docs: https://fakerphp.github.io/ 
 */

use Innoboxrr\Deals\Models\DealAdvertiserAgreementDaily;
use Innoboxrr\Deals\Models\DealAdvertiserAgreement;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealAdvertiserAgreementDailyFactory extends Factory
{

    protected $model = DealAdvertiserAgreementDaily::class;

    public function definition()
    {
        return [
            'date' => $this->faker->date(),
            'start_hour' => '08:00:00',
            'end_hour' => '20:00:00',
            'cpl' => $this->faker->randomFloat(2, 5, 100),
            'budget' => $this->faker->randomFloat(2, 500, 5000),
            'deal_advertiser_agreement_id' => DealAdvertiserAgreement::factory(),
        ];
    }

}
