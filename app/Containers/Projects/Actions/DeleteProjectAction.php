<?php

namespace App\Containers\Projects\Actions;

use App\Containers\Projects\Dto\DeleteProjectDto;
use App\Containers\Projects\Models\Project;
use App\Ship\Abstracts\Actions\Action;
use App\Ship\Abstracts\Responders\Responder;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final readonly class DeleteProjectAction extends Action
{
    public function run(
        DeleteProjectDto $dto,
    ): Responder {
        try {
            $project = Project::query()
                ->where('uuid', $dto->uuid())
                ->where('user_uuid', $dto->userUuid())
                ->firstOrFail();

            $result = $project->delete();

            return $this->success(
                data: $result,
            );
        } catch (ModelNotFoundException $exception) {
            return $this->error(
                message: $exception->getMessage(),
            );
        }
    }
}
