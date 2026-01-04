<?php

namespace Database\Seeders;

use App\Containers\Bills\Models\Bill;
use App\Containers\Projects\Models\Project;
use App\Containers\Tasks\Models\Task;
use App\Containers\Users\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()
            ->create([
                'name'     => 'test user',
                'email'    => 'email@example.com',
                'password' => Hash::make('qwerqwer'),
            ]);

        $project = Project::factory()
            ->for($user)
            ->create();

        Task::factory()
            ->for($user)
            ->for($project)
            ->count(10)
            ->has(Bill::factory()->count(3))
            ->create();

        Task::factory()
            ->for($user)
            ->withoutProject()
            ->count(10)
            ->has(Bill::factory()->count(3))
            ->create();
    }
}
