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
            'title'        => $dto->title(),
            'stage'        => $dto->stage(),
            'description'  => $dto->description(),
            'deadline'     => $dto->deadline(),
            'project_uuid' => $dto->projectUuid(),
        ]);
    }
}
