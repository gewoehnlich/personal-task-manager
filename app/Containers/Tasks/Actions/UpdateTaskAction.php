<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Dto\UpdateTaskDto;
use App\Containers\Tasks\Models\Task;
use App\Ship\Abstracts\Actions\Action;
use App\Ship\Abstracts\Responders\Responder;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final readonly class UpdateTaskAction extends Action
{
    public function run(
        UpdateTaskDto $dto,
    ): Responder {
        try {
            $task = Task::query()
                ->where('uuid', $dto->uuid)
                ->where('user_uuid', $dto->userUuid)
                ->firstOrFail();

            $result = $task->update(
                attributes: $dto->toArray(),
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
