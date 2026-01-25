<?php

namespace App\Containers\Projects\Actions;

use App\Containers\Projects\Dto\UpdateProjectDto;
use App\Containers\Projects\Models\Project;
use App\Ship\Abstracts\Actions\Action;
use App\Ship\Abstracts\Responses\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final readonly class UpdateProjectAction extends Action
{
    public function run(
        UpdateProjectDto $dto,
    ): Response {
        try {
            $project = Project::query()
                ->where('uuid', $dto->uuid())
                ->where('user_uuid', $dto->userUuid())
                ->firstOrFail();

            $result = $project->update(
                attributes: $dto->toArray(),
            );

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
