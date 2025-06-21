<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'task_id' => 1,
            'description' => $this->faker->paragraph,
            'time_spent' => $this->faker->numberBetween(5, 120),
            'performed_at' => $this->faker->dateTimeBetween('-10 hours', 'now'),
        ];
    }
}
