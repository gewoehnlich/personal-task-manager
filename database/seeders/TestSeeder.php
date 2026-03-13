<?php

namespace Database\Seeders;

use App\Containers\Projects\Models\Project;
use App\Containers\Users\Models\User;
use Illuminate\Database\Seeder;

final class TestSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()
            ->create();

        $project = Project::factory()
            ->for($user)
            ->create();
    }
}
