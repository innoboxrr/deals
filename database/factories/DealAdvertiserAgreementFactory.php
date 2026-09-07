<?php

namespace Innoboxrr\Deals\Database\Factories;

/*
 * Docs: https://fakerphp.github.io/ 
 */

use Innoboxrr\Deals\Models\DealAdvertiserAgreement;
use Innoboxrr\Deals\Models\DealAdvertiser;
use Innoboxrr\Deals\Models\Deal;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealAdvertiserAgreementFactory extends Factory
{

    protected $model = DealAdvertiserAgreement::class;

    public function definition()
    {
        return [
            'status' => 'active',
            'deal_advertiser_id' => DealAdvertiser::factory(),
            'deal_id' => Deal::factory(),
        ];
    }

}
