<?php

namespace Innoboxrr\Deals\Database\Factories;

/*
 * Docs: https://fakerphp.github.io/ 
 */

use Innoboxrr\Deals\Models\DealAssignment;
use Innoboxrr\Deals\Models\DealLead;
use Innoboxrr\Deals\Models\DealAdvertiserAgreement;
use Innoboxrr\Deals\Models\DealRouterExecution;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealAssignmentFactory extends Factory
{

    protected $model = DealAssignment::class;

    public function definition()
    {
        return [
            'deal_lead_id' => DealLead::factory(),
            'deal_advertiser_agreement_id' => DealAdvertiserAgreement::factory(),
        ];
    }

}
