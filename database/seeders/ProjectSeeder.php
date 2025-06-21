<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

final class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::factory()->count(3)->create();
    }
}
