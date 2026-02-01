<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Dto\DeleteTaskDto;
use App\Containers\Tasks\Dto\FindTaskByUuidAndUserUuidDto;
use App\Containers\Tasks\Tasks\FindTaskByUuidAndUserUuidTask;
use App\Ship\Abstracts\Actions\Action;

final readonly class DeleteTaskAction extends Action
{
    public function run(
        DeleteTaskDto $dto,
    ): bool {
        $project = $this->task(
            class: FindTaskByUuidAndUserUuidTask::class,
            dto: new FindTaskByUuidAndUserUuidDto(
                uuid: $dto->uuid,
                userUuid: $dto->userUuid,
            ),
        );

        return $project->delete();
    }
}
