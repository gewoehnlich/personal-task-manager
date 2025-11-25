<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Enums\Stage;
use App\Containers\Tasks\Models\Task;
use App\Containers\Tasks\Transporters\TaskDeleteTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;

final readonly class TaskDeleteAction extends Action
{
    public function run(
        TaskDeleteTransporter $transporter,
    ): Responder {
        try {
            $task = Task::where('id', $transporter->id)
                ->where('user_id', $transporter->userId)
                ->first();

            if (!isset($task)) {
                throw new Exception('can\'t find task.');
            }

            $task->update([
                'stage' => Stage::DELETED,
            ]);

            return $this->success(
                data: ['result' => true],
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getErrors(),
            );
        }
    }
}
