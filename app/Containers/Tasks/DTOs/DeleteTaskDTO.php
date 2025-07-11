<?php

namespace App\Containers\Tasks\DTOs;

use App\Http\Requests\API\Tasks\DeleteTaskRequest;

final class DeleteTaskDTO extends TaskDTO
{
    final public readonly int $id;
    final public readonly int $userId;

    public function __construct(DeleteTaskRequest $request)
    {
        $this->id     = $request->id;
        $this->userId = $request->user_id;
    }
}
