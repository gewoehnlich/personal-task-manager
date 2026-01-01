<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Models\Task;
use App\Containers\Tasks\Transporters\UpdateTaskTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Abstracts\Actions\Action;
use App\Ship\Abstracts\Exceptions\Exception;

final readonly class UpdateTaskAction extends Action
{
    public function run(
        UpdateTaskTransporter $transporter,
    ): Responder {
        try {
            $task = Task::where('id', $transporter->id)
                ->where('user_id', $transporter->userId)
                ->first();

            if (! isset($task)) {
                throw new Exception('can\'t find task.');
            }

            $result = $task->update(
                attributes: $transporter->toArray(),
            );

            return $this->success(
                data: $result,
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getErrors(),
            );
        }
    }
}
