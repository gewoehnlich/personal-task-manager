<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'userId' => 1,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'taskStatus' => $this->faker->randomElement([
                'pending',
                'active',
                'delayed',
                'done'
            ]),
            'deadline' => $this->faker->dateTimeBetween('now', '+10 days'),
        ];
    }
}
