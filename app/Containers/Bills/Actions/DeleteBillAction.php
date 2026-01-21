<?php

namespace App\Containers\Bills\Actions;

use App\Containers\Bills\Dto\DeleteBillDto;
use App\Containers\Bills\Models\Bill;
use App\Containers\Tasks\Models\Task;
use App\Ship\Abstracts\Actions\Action;
use App\Ship\Abstracts\Responders\Responder;
use Exception;

final readonly class DeleteBillAction extends Action
{
    public function run(
        DeleteBillDto $dto,
    ): Responder {
        try {
            $task = Task::query()
                ->where('uuid', $dto->taskUuid)
                ->where('user_uuid', $dto->userUuid)
                ->firstOrFail();

            $bill = Bill::query()
                ->where('uuid', $dto->uuid)
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
