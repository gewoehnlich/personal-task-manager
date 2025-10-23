<?php

namespace App\Containers\Tasks\Views;

use App\Containers\Tasks\Enums\Stage;
use App\Containers\Tasks\Repositories\TaskRepository;
use App\Ship\Parents\Views\JsonModel;

final class TaskIndexViewModel extends JsonModel
{
    public function pending(): array
    {
        return TaskRepository::where([
            'stage' => Stage::PENDING,
            'deleted' => false,
        ]);
    }

    public function active(): array
    {
        return TaskRepository::where([
            'stage' => Stage::ACTIVE,
            'deleted' => false,
        ]);
    }

    public function delayed(): array
    {
        return TaskRepository::where([
            'stage' => Stage::DELAYED,
            'deleted' => false,
        ]);
    }

    public function done(): array
    {
        return TaskRepository::where([
            'stage' => Stage::DONE,
            'deleted' => false,
        ]);
    }

    public function deleted(): array
    {
        return TaskRepository::where([
            'deleted' => true,
        ]);
    }
}
