<?php

namespace App\Containers\Tasks\Factories;

use App\Containers\Projects\Models\Project;
use App\Containers\Tasks\Models\Task;
use App\Containers\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

final class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'user_uuid'    => User::all()->random()->uuid,
            'title'        => $this->faker->sentence,
            'description'  => $this->faker->paragraph,
            'stage'        => $this->faker->randomElement([
                'pending',
                'active',
                'done',
            ]),
            'deadline'     => $this->faker->dateTimeBetween('now', '+10 days'),
            'debug'        => true,
            'project_uuid' => Project::all()->random()->uuid,
        ];
    }
}
