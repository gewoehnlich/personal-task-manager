<?php

namespace App\Containers\Bills\Actions;

use App\Containers\Bills\Models\Bill;
use App\Containers\Bills\Transporters\UpdateBillTransporter;
use App\Containers\Tasks\Models\Task;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;
use Exception;

final readonly class UpdateBillAction extends Action
{
    public function run(
        UpdateBillTransporter $transporter,
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

            $result = $bill->update(
                attributes: $transporter->toArray(),
            );

            return $this->success(
                data: $result,
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getMessage(),
            );
        }
    }
}
