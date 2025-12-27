<?php

namespace App\Containers\Bills\Factories;

use App\Containers\Bills\Models\Bill;
use App\Containers\Tasks\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class BillFactory extends Factory
{
    protected $model = Bill::class;

    public function definition(): array
    {
        return [
            'task_id' => Task::where('debug', true)
                ->inRandomOrder()
                ->first()
                ->id,
            'description'  => $this->faker->text(100),
            'time_spent'   => $this->faker->numberBetween(30, 180),
            'performed_at' => $this->faker->dateTimeThisYear(),
        ];
    }
}
