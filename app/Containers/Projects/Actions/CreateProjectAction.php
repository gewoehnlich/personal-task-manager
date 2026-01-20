<?php

namespace App\Containers\Projects\Actions;

use App\Containers\Projects\Models\Project;
use App\Containers\Projects\DTO\CreateProjectDto;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Abstracts\Actions\Action;

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
