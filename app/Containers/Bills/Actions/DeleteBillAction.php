<?php

namespace App\Containers\Bills\Actions;

use App\Containers\Bills\Models\Bill;
use App\Containers\Bills\Transporters\DeleteBillTransporter;
use App\Containers\Tasks\Models\Task;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Abstracts\Actions\Action;
use Exception;

final readonly class DeleteBillAction extends Action
{
    public function run(
        DeleteBillTransporter $transporter,
    ): Responder {
        try {
            $task = Task::query()
                ->where('uuid', $transporter->taskUuid)
                ->where('user_uuid', $transporter->userUuid)
                ->firstOrFail();

            $bill = Bill::query()
                ->where('uuid', $transporter->uuid)
                ->where('task_uuid', $task->uuid)
                ->firstOrFail();

            $bill->delete();

            return $this->success(
                data: true,
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getMessage(),
            );
        }
    }
}
