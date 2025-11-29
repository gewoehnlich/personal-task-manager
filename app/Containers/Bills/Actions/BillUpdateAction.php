<?php

namespace App\Containers\Bills\Actions;

use App\Containers\Bills\Models\Bill;
use App\Containers\Bills\Transporters\BillUpdateTransporter;
use App\Containers\Tasks\Models\Task;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;

final readonly class BillUpdateAction extends Action
{
    public function run(
        BillUpdateTransporter $transporter,
    ): Responder {
        try {
            $task = Task::query()
                ->where('id', $transporter->taskId)
                ->where('user_id', $transporter->userId)
                ->first();

            if (!isset($task)) {
                throw new Exception('can\'t find task.');
            }

            $bill = Bill::query()
                ->where('id', $transporter->id)
                ->where('task_id', $transporter->taskId)
                ->first();

            if (!isset($bill)) {
                throw new Exception('can\'t find the bill.');
            }

            $result = $bill->update(
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
