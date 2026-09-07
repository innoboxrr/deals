<?php

namespace Innoboxrr\Deals\Database\Factories;

/*
 * Docs: https://fakerphp.github.io/ 
 */

use Innoboxrr\Deals\Models\DealAdvertiserAgreementInvoice;
use Innoboxrr\Deals\Models\DealAdvertiser;
use Innoboxrr\Deals\Models\DealAdvertiserAgreement;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealAdvertiserAgreementInvoiceFactory extends Factory
{

    protected $model = DealAdvertiserAgreementInvoice::class;

    public function definition()
    {
        return [
            'from_date' => $this->faker->date(),
            'to_date' => $this->faker->date(),
            'total' => $this->faker->randomFloat(2, 100, 10000),
            'status' => 'pending',
            'deal_advertiser_id' => DealAdvertiser::factory(),
            'deal_advertiser_agreement_id' => DealAdvertiserAgreement::factory(),
        ];
    }

}
