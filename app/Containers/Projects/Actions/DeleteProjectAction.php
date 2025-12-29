<?php

namespace App\Containers\Projects\Actions;

use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Transporters\DeleteProjectTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;

final readonly class DeleteProjectAction extends Action
{
    public function run(
        DeleteProjectTransporter $transporter,
    ): Responder {
        try {
            $project = Project::query()
                ->where('id', $transporter->id)
                ->where('user_id', $transporter->userId)
                ->first();

            if (! isset($project)) {
                throw new Exception('can\'t find project.');
            }

            $project->delete();

            return $this->success(
                data: true,
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getErrors(),
            );
        }
    }
}
