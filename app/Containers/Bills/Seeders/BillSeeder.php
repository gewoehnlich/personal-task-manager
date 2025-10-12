<?php

namespace App\Containers\Bills\Seeders;

use App\Containers\Bills\Models\Bill;
use Illuminate\Database\Seeder;

class BillSeeder extends Seeder
{
    public function run(): void
    {
        Bill::factory()->count(10)->create();
    }
}
