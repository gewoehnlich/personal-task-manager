<?php

namespace App\Containers\Projects\Actions;

use App\Containers\Projects\Dto\UpdateProjectDto;
use App\Ship\Abstracts\Actions\Action;

final readonly class UpdateProjectAction extends Action
{
    public function run(
        UpdateProjectDto $dto,
    ): bool {
        return $dto->project->update([
            'title'       => $dto->title?->value(),
            'description' => $dto->description?->value(),
        ]);
    }
}
