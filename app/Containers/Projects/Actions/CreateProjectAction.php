<?php

namespace App\Containers\Projects\Actions;

use App\Containers\Projects\Dto\CreateProjectDto;
use App\Containers\Projects\Models\Project;
use App\Ship\Abstracts\Actions\Action;
use App\Ship\Abstracts\Responses\Response;

final readonly class CreateProjectAction extends Action
{
    public function run(
        CreateProjectDto $dto,
    ): Response {
        $project = Project::create(
            attributes: $dto->toArray(),
        );

        return $this->success(
            data: $project,
        );
    }
}
