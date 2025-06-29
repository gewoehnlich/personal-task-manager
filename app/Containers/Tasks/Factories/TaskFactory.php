<?php

namespace App\Containers\Tasks\Factories;

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
            'user_id'      => 1,
            'title'        => $this->faker->sentence,
            'description'  => $this->faker->paragraph,
            'stage'        => $this->faker->randomElement([
                'pending',
                'active',
                'delayed',
                'done',
            ]),
            'project_id' => 1,
            'deadline'   => $this->faker->dateTimeBetween('now', '+10 days'),
        ];
    }
}
