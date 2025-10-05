<?php

namespace App\Containers\Bills\Repositories;

use App\Containers\Bills\Models\Bill;
use App\Ship\Parents\Repositories\Repository;

final class BillRepository extends Repository
{
    public function model(): string
    {
        return Bill::class;
    }
}
