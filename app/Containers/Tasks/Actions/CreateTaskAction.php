<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Dto\CreateTaskDto;
use App\Containers\Tasks\Models\Task;
use App\Ship\Abstracts\Actions\Action;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;

#[Authenticated]
#[Group('TaskActions')]
final readonly class CreateTaskAction extends Action
{
    public function run(
        CreateTaskDto $dto,
    ): Task {
        return Task::create(
            attributes: $dto->toArray(),
        );
    }
}
