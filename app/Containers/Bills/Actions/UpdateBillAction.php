<?php

namespace App\Containers\Bills\Actions;

use App\Containers\Bills\Dto\UpdateBillDto;
use App\Containers\Bills\Models\Bill;
use App\Containers\Tasks\Models\Task;
use App\Ship\Abstracts\Actions\Action;
use App\Ship\Abstracts\Responders\Responder;
use Exception;

final readonly class UpdateBillAction extends Action
{
    public function run(
        UpdateBillDto $dto,
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

            $result = $bill->update(
                attributes: $dto->toArray(),
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
