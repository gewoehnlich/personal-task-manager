<?php

namespace Database\Seeders;

use App\Containers\Bills\Seeders\BillSeeder;
use App\Containers\Projects\Seeders\ProjectSeeder;
use App\Containers\Tasks\Seeders\TaskSeeder;
use App\Containers\Users\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(BillSeeder::class);
    }
}
