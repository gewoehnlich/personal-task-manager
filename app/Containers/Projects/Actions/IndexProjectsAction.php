<?php

namespace App\Containers\Projects\Actions;

use App\Containers\Projects\Dto\IndexProjectsDto;
use App\Containers\Projects\Repositories\ProjectRepository;
use App\Ship\Abstracts\Actions\Action;
use Illuminate\Support\Collection;

final readonly class IndexProjectsAction extends Action
{
    public function run(
        IndexProjectsDto $dto,
    ): Collection {
        return ProjectRepository::byUser(
            user: $dto->user,
        );
    }
}
