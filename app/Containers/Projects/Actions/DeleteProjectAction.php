<?php

namespace App\Containers\Projects\Actions;

use App\Containers\Projects\Dto\DeleteProjectDto;
use App\Containers\Projects\Dto\FindProjectByUuidAndUserUuidDto;
use App\Containers\Projects\Tasks\FindProjectByUuidAndUserUuidTask;
use App\Ship\Abstracts\Actions\Action;

final readonly class DeleteProjectAction extends Action
{
    public function run(
        DeleteProjectDto $dto,
    ): bool {
        $project = $this->task(
            class: FindProjectByUuidAndUserUuidTask::class,
            dto: new FindProjectByUuidAndUserUuidDto(
                uuid: $dto->uuid,
                userUuid: $dto->userUuid,
            ),
        );

        return $project->delete();
    }
}
