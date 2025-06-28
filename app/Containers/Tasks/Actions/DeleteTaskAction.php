<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Transfers\Transporters\DeleteTaskTransporter;
use App\Models\Task;
use App\Ship\Tasks\Actions\TaskAction;

final abstract class DeleteTaskAction extends Action
{
    final public static function run(DeleteTaskTransporter $dto): Task
    {
        $task   = Task::where(['id' => $dto->id, 'user_id' => $dto->userId]);
        $result = $task->delete();

        return $result;
    }
}
