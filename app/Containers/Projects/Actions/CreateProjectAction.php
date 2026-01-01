<?php

namespace App\Containers\Projects\Actions;

use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Transporters\CreateProjectTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Abstracts\Actions\Action;

final readonly class CreateProjectAction extends Action
{
    public function run(
        CreateProjectTransporter $transporter,
    ): Responder {
        $project = Project::create(
            attributes: $transporter->toArray(),
        );

        return $this->success(
            data: $project->toArray(),
        );
    }
}
