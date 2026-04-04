<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Dto\DeleteTaskDto;
use App\Ship\Abstracts\Actions\Action;

final readonly class DeleteTaskAction extends Action
{
    public function run(
        DeleteTaskDto $dto,
    ): bool {
        if ($dto->force === true) {
            return $dto->task->forceDelete();
        }

        return $dto->task->delete();
    }
}
