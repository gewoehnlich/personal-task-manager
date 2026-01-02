<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Models\Task;
use App\Containers\Tasks\Transporters\CreateTaskTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Abstracts\Actions\Action;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;

#[Authenticated]
#[Group('TaskActions')]
final readonly class CreateTaskAction extends Action
{
    public function run(
        CreateTaskTransporter $transporter,
    ): Responder {
        $result = Task::create(
            attributes: $transporter->toArray(),
        );

        return $this->success(
            data: $result,
        );
    }
}
