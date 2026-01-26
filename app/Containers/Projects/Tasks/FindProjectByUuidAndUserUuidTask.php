<?php

namespace App\Containers\Projects\Tasks;

use App\Containers\Projects\Dto\FindProjectByUuidAndUserUuidDto;
use App\Containers\Projects\Exceptions\ProjectDoesNotBelongToAuthenticatedUserException;
use App\Containers\Projects\Exceptions\ProjectWithThisUuidDoesNotExistException;
use App\Containers\Projects\Models\Project;
use App\Ship\Abstracts\Tasks\Task;

final readonly class FindProjectByUuidAndUserUuidTask extends Task
{
    public function run(
        FindProjectByUuidAndUserUuidDto $dto,
    ): Project {
        $project = Project::query()
            ->where('uuid', $dto->uuid())
            ->first();

        if ($project === null) {
            throw new ProjectWithThisUuidDoesNotExistException(
                uuid: $dto->uuid(),
            );
        }

        if ($project->user_uuid !== $dto->userUuid()) {
            throw new ProjectDoesNotBelongToAuthenticatedUserException(
                uuid: $dto->uuid(),
            );
        }

        return $project;
    }
}
