<?php

namespace App\Containers\Tasks\Dto;

use App\Containers\Tasks\Models\Task;
use App\Containers\Tasks\Repositories\TaskRepository;
use App\Ship\Abstracts\Dto\Dto;

final readonly class DeleteTaskDto extends Dto
{
    public function __construct(
        private readonly Task $task,
        private readonly bool $force,
    ) {
        //
    }

    public function task(): Task
    {
        return $this->task;
    }

    public function force(): bool
    {
        return $this->force;
    }

    public static function from(
        array $inputData,
    ): self {
        return new self(
            task: TaskRepository::byUuid(
                uuid: $inputData['uuid'],
            ),
            force: $inputData['force'],
        );
    }
}
