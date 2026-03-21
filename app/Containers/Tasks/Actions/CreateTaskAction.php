<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Dto\CreateTaskDto;
use App\Containers\Tasks\Models\Task;
use App\Ship\Abstracts\Actions\Action;

final readonly class CreateTaskAction extends Action
{
    public function run(
        CreateTaskDto $dto,
    ): Task {
        return Task::create(
            attributes: [
                'user_uuid'    => $dto->userUuid(),
                'title'        => $dto->title(),
                'stage'        => $dto->stage(),
                'description'  => $dto->description(),
                'deadline'     => $dto->deadline(),
                'project_uuid' => $dto->projectUuid(),
            ],
        );
    }
}
