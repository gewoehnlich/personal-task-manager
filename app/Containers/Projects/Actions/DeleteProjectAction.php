<?php

namespace App\Containers\Projects\Actions;

use App\Containers\Projects\Dto\DeleteProjectDto;
use App\Ship\Abstracts\Actions\Action;

final readonly class DeleteProjectAction extends Action
{
    public function run(
        DeleteProjectDto $dto,
    ): bool {
        return $dto->project->delete();
    }
}
