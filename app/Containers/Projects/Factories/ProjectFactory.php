<?php

namespace App\Containers\Projects\Factories;

use App\Containers\Projects\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

final class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'title'       => $this->faker->word(),
            'description' => $this->faker->text(100),
        ];
    }
}
