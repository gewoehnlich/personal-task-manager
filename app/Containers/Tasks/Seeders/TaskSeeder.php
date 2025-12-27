<?php

namespace App\Containers\Tasks\Seeders;

use App\Containers\Tasks\Models\Task;
use Illuminate\Database\Seeder;

final class TaskSeeder extends Seeder
{
    public function run(): void
    {
        Task::factory()
            ->count(20)
            ->create();
    }
}
