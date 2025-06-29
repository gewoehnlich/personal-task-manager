<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\DTOs\UpdateTaskDTO;
use App\Containers\Tasks\Models\Task;
use App\Ship\Tasks\Actions\Action;

final abstract class UpdateTaskAction extends Action
{
    final public static function run(UpdateTaskDTO $dto): Task
    {
        $task   = Task::where([
            'id' => $dto->id,
            'user_id' => $dto->userId
        ]);

        $result = $task->update([
            'id'          => $dto->id,
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
