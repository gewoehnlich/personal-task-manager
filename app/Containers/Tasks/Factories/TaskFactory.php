<?php

namespace App\Containers\Tasks\Factories;

use App\Containers\Tasks\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'user_id' => 1,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'stage' => $this->faker->randomElement([
                'pending',
                'active',
                'done',
            ]),
            'deadline' => $this->faker->dateTimeBetween('now', '+10 days'),
            'debug' => true,
        ];
    }
}
