<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\DTOs\DeleteTaskDTO;
use App\Containers\Tasks\Models\Task;
use App\Ship\Tasks\Actions\Action;

final abstract class DeleteTaskAction extends Action
{
    final public static function run(DeleteTaskDTO $dto): Task
    {
        $task   = Task::where([
            'id' => $dto->id,
            'user_id' => $dto->userId
        ]);

        $result = $task->delete();

        return $result;
    }
}
