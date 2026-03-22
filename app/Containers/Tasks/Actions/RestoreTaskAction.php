<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Dto\RestoreTaskDto;
use App\Containers\Tasks\Exceptions\TaskIsNotSoftDeletedException;
use App\Ship\Abstracts\Actions\Action;

final readonly class RestoreTaskAction extends Action
{
    public function run(
        RestoreTaskDto $dto,
    ): bool {
        if ($dto->task()->trashed() === false) {
            throw new TaskIsNotSoftDeletedException(
                uuid: $dto->task()->uuid,
            );
        }

        return $dto->task()->restore();
    }
}
