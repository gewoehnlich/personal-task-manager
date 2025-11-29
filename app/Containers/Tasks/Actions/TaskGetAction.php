<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Models\Task;
use App\Containers\Tasks\Transporters\TaskGetTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;

final readonly class TaskGetAction extends Action
{
    public function run(
        TaskGetTransporter $transporter,
    ): Responder {
        try {
            $task = Task::where('id', $transporter->id)
                ->where('user_id', $transporter->userId)
                ->first();

            if (!isset($task)) {
                throw new Exception('can\'t find task.');
            }

            return $this->success(
                data: $task,
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getErrors(),
            );
        }
    }
}
