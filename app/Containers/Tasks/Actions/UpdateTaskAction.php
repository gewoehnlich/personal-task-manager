<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Models\Task;
use App\Containers\Tasks\Transporters\UpdateTaskTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Abstracts\Actions\Action;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final readonly class UpdateTaskAction extends Action
{
    public function run(
        UpdateTaskTransporter $transporter,
    ): Responder {
        try {
            $task = Task::query()
                ->where('uuid', $transporter->uuid)
                ->where('user_uuid', $transporter->userUuid)
                ->firstOrFail();

            $result = $task->update(
                attributes: $transporter->toArray(),
            );

            return $this->success(
                data: $result,
            );
        } catch (ModelNotFoundException $exception) {
            return $this->error(
                message: $exception->getMessage(),
            );
        }
    }
}
