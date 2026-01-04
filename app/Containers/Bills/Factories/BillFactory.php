<?php

namespace App\Containers\Bills\Factories;

use App\Containers\Bills\Models\Bill;
use Illuminate\Database\Eloquent\Factories\Factory;

final class BillFactory extends Factory
{
    protected $model = Bill::class;

    public function definition(): array
    {
        return [
            'description'   => $this->faker->text(100),
            'minutes_spent' => $this->faker->numberBetween(30, 180),
            'performed_at'  => $this->faker->dateTimeThisYear(),
        ];
    }
}
