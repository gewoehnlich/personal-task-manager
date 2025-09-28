<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\DTOs\CreateTaskDTO;
use App\Containers\Tasks\Models\Task;
use App\Ship\Parents\Actions\Action;

final readonly class CreateTaskAction extends Action
{
    public static function run(
        CreateTaskDTO $dto
    ): Task {
        $result = Task::create([
            'user_id'     => $dto->userId,
            'title'       => $dto->title,
            'description' => $dto->description,
            'stage'       => $dto->stage,
            'deadline'    => $dto->deadline,
            'parent_id'   => $dto->parentId,
            'project_id'  => $dto->projectId,
        ]);

        return $result;
    }
}
