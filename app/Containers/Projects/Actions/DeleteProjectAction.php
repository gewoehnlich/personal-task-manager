<?php

namespace App\Containers\Projects\Actions;

use App\Containers\Projects\Dto\DeleteProjectDto;
use App\Ship\Abstracts\Actions\Action;

final readonly class DeleteProjectAction extends Action
{
    public function run(
        DeleteProjectDto $dto,
    ): bool {
        if ($dto->force() === true) {
            return $dto->project->forceDelete();
        }

        return $dto->project->delete();
    }
}
