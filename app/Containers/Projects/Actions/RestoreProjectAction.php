<?php

namespace App\Containers\Projects\Actions;

use App\Containers\Projects\Dto\RestoreProjectDto;
use App\Containers\Projects\Exceptions\ProjectIsNotSoftDeletedException;
use App\Ship\Abstracts\Actions\Action;

final readonly class RestoreProjectAction extends Action
{
    public function run(
        RestoreProjectDto $dto,
    ): bool {
        if ($dto->project->trashed() === false) {
            throw new ProjectIsNotSoftDeletedException(
                uuid: $dto->project->uuid,
            );
        }

        return $dto->project->restore();
    }
}
