<?php

namespace App\Containers\Projects\Actions;

use App\Containers\Projects\DTO\CreateProjectDto;
use App\Containers\Projects\Models\Project;
use App\Ship\Abstracts\Actions\Action;
use App\Ship\Abstracts\Responders\Responder;

final readonly class CreateProjectAction extends Action
{
    public function run(
        CreateProjectDto $dto,
    ): Responder {
        $project = Project::create(
            attributes: $dto->toArray(),
        );

        return $this->success(
            data: $project,
        );
    }
}
