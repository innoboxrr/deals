<?php

namespace Innoboxrr\Deals\Database\Factories;

/*
 * Docs: https://fakerphp.github.io/ 
 */

use Innoboxrr\Deals\Models\DealAdvertiser;
use Innoboxrr\Deals\Models\Deal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealAdvertiserFactory extends Factory
{

    protected $model = DealAdvertiser::class;

    public function definition()
    {
        return [
            'agent_id' => User::factory(),
            'status' => 'active',
        ];
    }

}
