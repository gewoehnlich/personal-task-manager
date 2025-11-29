<?php

namespace App\Containers\Projects\Factories;

use App\Containers\Projects\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'name'        => $this->faker->word(),
            'description' => $this->faker->text(100),
            'deleted'     => false,
        ];
    }
}
