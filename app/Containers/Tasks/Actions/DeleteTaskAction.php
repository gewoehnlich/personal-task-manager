<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Models\Task;
use App\Containers\Tasks\Transporters\DeleteTaskTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Abstracts\Actions\Action;

final readonly class DeleteTaskAction extends Action
{
    public function run(
        DeleteTaskTransporter $transporter,
    ): Responder {
        $task = Task::query()
            ->where('uuid', $transporter->uuid)
            ->where('user_uuid', $transporter->userUuid)
            ->firstOrFail();

        $task->delete();

        return $this->success(
            data: true,
        );
    }
}
