<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Enums\Stage;
use App\Containers\Tasks\Models\Task;
use App\Containers\Tasks\Transporters\DeleteTaskTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;

final readonly class DeleteTaskAction extends Action
{
    public function run(
        DeleteTaskTransporter $transporter,
    ): Responder {
        try {
            $task = Task::where('id', $transporter->id)
                ->where('user_id', $transporter->userId)
                ->first();

            if (! isset($task)) {
                throw new Exception('can\'t find task.');
            }

            $task->update([
                'stage' => Stage::DELETED,
            ]);

            return $this->success(
                data: true,
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getErrors(),
            );
        }
    }
}
