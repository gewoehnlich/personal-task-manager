<?php

namespace App\Containers\Projects\Seeders;

use App\Containers\Projects\Models\Project;
use Illuminate\Database\Seeder;

final class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::factory()
            ->count(1)
            ->create();
    }
}
