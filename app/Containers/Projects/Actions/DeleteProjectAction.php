<?php

namespace App\Containers\Projects\Actions;

use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Transporters\DeleteProjectTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Abstracts\Actions\Action;

final readonly class DeleteProjectAction extends Action
{
    public function run(
        DeleteProjectTransporter $transporter,
    ): Responder {
        $project = Project::query()
            ->where('uuid', $transporter->uuid)
            ->where('user_uuid', $transporter->userUuid)
            ->firstOrFail();

        $result = $project->delete();

        return $this->success(
            data: $result,
        );
    }
}
