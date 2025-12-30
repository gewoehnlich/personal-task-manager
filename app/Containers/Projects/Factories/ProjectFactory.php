<?php

namespace App\Containers\Projects\Factories;

use App\Containers\Projects\Models\Project;
use App\Containers\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

final class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'name'        => $this->faker->word(),
            'description' => $this->faker->text(100),
            'user_uuid'   => User::all()->random()->uuid,
        ];
    }
}
