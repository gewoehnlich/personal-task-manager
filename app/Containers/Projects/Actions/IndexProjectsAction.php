<?php

namespace App\Containers\Projects\Actions;

use App\Containers\Projects\Dto\IndexProjectsDto;
use App\Containers\Projects\Models\Project;
use App\Ship\Abstracts\Actions\Action;
use App\Ship\Abstracts\Responses\Response;

final readonly class IndexProjectsAction extends Action
{
    public function run(
        IndexProjectsDto $dto,
    ): Response {
        $result = Project::query()
            ->where('user_uuid', $dto->userUuid())
            ->get();

        return $this->success(
            data: $result,
        );
    }
}
