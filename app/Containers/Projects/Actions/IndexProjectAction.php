<?php

namespace App\Containers\Projects\Actions;

use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Transporters\IndexProjectTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;

final readonly class IndexProjectAction extends Action
{
    public function run(
        IndexProjectTransporter $transporter,
    ): Responder {
        $result = Project::query()
            ->where('user_uuid', $transporter->userUuid)
            ->get();

        return $this->success(
            data: $result,
        );
    }
}
