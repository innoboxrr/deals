<?php

namespace Innoboxrr\Deals\Database\Factories;

/*
 * Docs: https://fakerphp.github.io/ 
 */

use Innoboxrr\Deals\Models\DealRouterExecution;
use Innoboxrr\Deals\Models\DealRouter;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealRouterExecutionFactory extends Factory
{

    protected $model = DealRouterExecution::class;

    public function definition()
    {
        return [
            'start_execution' => $this->faker->dateTimeThisMonth(),
            'assignment_log' => [],
            'deal_router_id' => DealRouter::factory(),
        ];
    }

}
