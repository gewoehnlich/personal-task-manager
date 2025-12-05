<?php

namespace App\Containers\Projects\Actions;

use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Transporters\UpdateProjectTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;

final readonly class UpdateProjectAction extends Action
{
    public function run(
        UpdateProjectTransporter $transporter,
    ): Responder {
        try {
            $project = Project::query()
                ->where('id', $transporter->id)
                ->where('user_id', $transporter->userId)
                ->first();

            if (!isset($project)) {
                throw new Exception('can\'t find project.');
            }

            $result = $project->update(
                attributes: $transporter->toArray(),
            );

            return $this->success(
                data: $result,
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getErrors(),
            );
        }
    }
}
