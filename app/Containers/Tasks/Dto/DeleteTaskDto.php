<?php

namespace App\Containers\Tasks\Dto;

use App\Containers\Tasks\Models\Task;
use App\Containers\Tasks\Repositories\TaskRepository;
use App\Ship\Abstracts\Dto\Dto;

final readonly class DeleteTaskDto extends Dto
{
    public function __construct(
        public readonly Task $task,
        public readonly bool $force,
    ) {
        //
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
