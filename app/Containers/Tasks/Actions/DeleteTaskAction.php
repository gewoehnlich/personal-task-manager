<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Dto\DeleteTaskDto;
use App\Containers\Tasks\Models\Task;
use App\Ship\Abstracts\Actions\Action;
use App\Ship\Abstracts\Responders\Responder;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final readonly class DeleteTaskAction extends Action
{
    public function run(
        DeleteTaskDto $dto,
    ): Responder {
        try {
            $task = Task::query()
                ->where('uuid', $dto->uuid)
                ->where('user_uuid', $dto->userUuid)
                ->firstOrFail();

            $task->delete();

            return $this->success(
                data: true,
            );
        } catch (ModelNotFoundException $exception) {
            return $this->error(
                message: $exception->getMessage(),
            );
        }
    }
}
