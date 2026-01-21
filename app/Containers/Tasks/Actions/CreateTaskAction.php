<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Dto\CreateTaskDto;
use App\Containers\Tasks\Models\Task;
use App\Ship\Abstracts\Actions\Action;
use App\Ship\Abstracts\Responders\Responder;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;

#[Authenticated]
#[Group('TaskActions')]
final readonly class CreateTaskAction extends Action
{
    public function run(
        CreateTaskDto $dto,
    ): Responder {
        $result = Task::create(
            attributes: $dto->toArray(),
        );

        return $this->success(
            data: $result,
        );
    }
}
