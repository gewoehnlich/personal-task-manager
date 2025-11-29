<?php

namespace App\Containers\Users\Seeders;

use App\Containers\Users\Models\User;
use Illuminate\Database\Seeder;

final class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'test user',
            'email'    => 'email@example.com',
            'password' => 'qwerqwer',
        ]);
    }
}
