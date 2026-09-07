<?php

namespace Innoboxrr\Deals\Database\Factories;

/*
 * Docs: https://fakerphp.github.io/ 
 */

use Innoboxrr\Deals\Models\DealRouter;
use Innoboxrr\Deals\Models\Deal;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealRouterFactory extends Factory
{

    protected $model = DealRouter::class;

    public function definition()
    {
        return [
            'deal_id' => Deal::factory(),
        ];
    }

}
