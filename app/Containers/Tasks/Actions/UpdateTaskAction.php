<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Dto\UpdateTaskDto;
use App\Ship\Abstracts\Actions\Action;

final readonly class UpdateTaskAction extends Action
{
    public function run(
        UpdateTaskDto $dto,
    ): bool {
        return $dto->task->update([
            'title'        => $dto->title->value(),
            'stage'        => $dto->stage->value(),
            'description'  => $dto->description?->value(),
            'deadline'     => $dto->deadline?->value(),
            'project_uuid' => $dto->project?->uuid,
        ]);
    }
}
