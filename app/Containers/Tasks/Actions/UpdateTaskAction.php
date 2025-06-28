<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Transfers\Transporters\UpdateTaskTransporter;
use App\Models\Task;
use App\Ship\Tasks\Actions\TaskAction;

final abstract class UpdateTaskAction extends Action
{
    final public static function run(UpdateTaskTransporter $dto): Task
    {
        $task   = Task::where(['id' => $dto->id, 'user_id' => $dto->userId]);
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
