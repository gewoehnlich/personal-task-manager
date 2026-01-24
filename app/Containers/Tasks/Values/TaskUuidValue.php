<?php

namespace App\Containers\Tasks\Values;

use App\Containers\Tasks\Exceptions\TaskWithThisUuidDoesNotExistException;
use App\Containers\Tasks\Models\Task;
use App\Ship\Values\UuidValue;

final readonly class TaskUuidValue extends UuidValue
{
    protected function validate(): void
    {
        parent::validate();

        $this->doesTaskWithThisUuidExist();
    }

    private function doesTaskWithThisUuidExist(): void
    {
        $task = Task::query()
            ->where('uuid', $this->uuid)
            ->first();

        if ($task === null) {
            throw new TaskWithThisUuidDoesNotExistException(
                uuid: $this->uuid,
            );
        }
    }
}
