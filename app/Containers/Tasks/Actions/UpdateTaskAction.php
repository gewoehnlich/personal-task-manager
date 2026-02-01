<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Dto\FindTaskByUuidAndUserUuidDto;
use App\Containers\Tasks\Dto\UpdateTaskDto;
use App\Containers\Tasks\Tasks\FindTaskByUuidAndUserUuidTask;
use App\Ship\Abstracts\Actions\Action;

final readonly class UpdateTaskAction extends Action
{
    public function run(
        UpdateTaskDto $dto,
    ): bool {
        $project = $this->task(
            class: FindTaskByUuidAndUserUuidTask::class,
            dto: new FindTaskByUuidAndUserUuidDto(
                uuid: $dto->uuid,
                userUuid: $dto->userUuid,
            ),
        );

        return $project->update(
            attributes: $dto->toArray(),
        );
    }
}
