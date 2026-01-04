<?php

namespace App\Containers\Tasks\Factories;

use App\Containers\Tasks\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

final class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'title'       => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'stage'       => $this->faker->randomElement([
                'pending',
                'active',
                'done',
            ]),
            'deadline'    => $this->faker->dateTimeBetween('now', '+10 days'),
        ];
    }

    public function withoutProject(): static
    {
        return $this->state(fn () => [
            'project_uuid' => null,
        ]);
    }
}
