<?php

namespace App\Containers\Tasks\Dto;

use App\Containers\Tasks\Models\Task;
use App\Containers\Tasks\Repositories\TaskRepository;
use App\Ship\Abstracts\Dto\Dto;

final readonly class RestoreTaskDto extends Dto
{
    public function __construct(
        public readonly Task $task,
    ) {
        //
    }

    public function taskUuid(): string
    {
        return $this->task->uuid;
    }

    public static function from(
        array $inputData,
    ): self {
        return new self(
            task: TaskRepository::byUuid(
                uuid: $inputData['uuid'],
            ),
        );
    }
}
