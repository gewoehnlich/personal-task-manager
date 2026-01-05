<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Models\Task;
use App\Containers\Tasks\Transporters\DeleteTaskTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Abstracts\Actions\Action;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final readonly class DeleteTaskAction extends Action
{
    public function run(
        DeleteTaskTransporter $transporter,
    ): Responder {
        try {
            $task = Task::query()
                ->where('uuid', $transporter->uuid)
                ->where('user_uuid', $transporter->userUuid)
                ->firstOrFail();

            $task->delete();

            return $this->success(
                data: true,
            );
        } catch (ModelNotFoundException $exception) {
            return $this->error(
                message: $exception->getMessage(),
            );
        }
    }
}
