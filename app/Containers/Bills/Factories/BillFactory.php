<?php

namespace App\Containers\Bills\Factories;

use App\Containers\Bills\Models\Bill;
use Illuminate\Database\Eloquent\Factories\Factory;

class BillFactory extends Factory
{
    protected $model = Bill::class;

    public function definition(): array
    {
        return [
            'task_id' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->text(100),
            'time_spent' => $this->faker->numberBetween(30, 180),
            'performed_at' => $this->faker->dateTimeThisYear(),
            'deleted' => false,
        ];
    }
}
