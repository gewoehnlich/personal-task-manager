<?php

namespace App\Containers\Tasks\Repositories;

use App\Containers\Tasks\Models\Task;
use App\Ship\Parents\Repositories\Repository;

final class TaskRepository extends Repository
{
    public function model(): string
    {
        return Task::class;
    }
}
