<?php

namespace App\Containers\Projects\Actions;

use App\Containers\Projects\Dto\CreateProjectDto;
use App\Containers\Projects\Models\Project;
use App\Ship\Abstracts\Actions\Action;

final readonly class CreateProjectAction extends Action
{
    public function run(
        CreateProjectDto $dto,
    ): Project {
        return Project::create(
            attributes: $dto->toArray(),
        );
    }
}
