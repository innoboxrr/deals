<?php

namespace Innoboxrr\Deals\Database\Factories;

/*
 * Docs: https://fakerphp.github.io/
 */

use Innoboxrr\Deals\Models\Deal;
use Innoboxrr\Deals\Enums\Deal\Status;
use App\Models\Workspace;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealFactory extends Factory
{

    protected $model = Deal::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(Status::cases())->value,
            'workspace_id' => Workspace::factory(),
        ];
    }

}
