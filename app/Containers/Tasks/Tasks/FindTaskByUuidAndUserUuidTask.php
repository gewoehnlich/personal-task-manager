<?php

namespace App\Containers\Tasks\Tasks;

use App\Containers\Tasks\Dto\FindTaskByUuidAndUserUuidDto;
use App\Containers\Tasks\Exceptions\TaskDoesNotBelongToAuthenticatedUserException;
use App\Containers\Tasks\Exceptions\TaskWithThisUuidDoesNotExistException;
use App\Containers\Tasks\Models\Task as TaskModel;
use App\Ship\Abstracts\Tasks\Task;

final readonly class FindTaskByUuidAndUserUuidTask extends Task
{
    public function run(
        FindTaskByUuidAndUserUuidDto $dto,
    ): TaskModel {
        $task = TaskModel::query()
            ->where('uuid', $dto->uuid())
            ->first();

        if ($task === null) {
            throw new TaskWithThisUuidDoesNotExistException(
                uuid: $dto->uuid(),
            );
        }

        if ($task->user_uuid !== $dto->userUuid()) {
            throw new TaskDoesNotBelongToAuthenticatedUserException(
                uuid: $dto->uuid(),
            );
        }

        return $task;
    }
}
