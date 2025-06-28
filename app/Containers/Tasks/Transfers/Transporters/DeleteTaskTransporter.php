<?php

namespace App\DTO\API\Tasks;

use App\Http\Requests\API\Tasks\DeleteTaskRequest;

final class DeleteTaskTransporter extends TaskDTO
{
    final public readonly int $id;
    final public readonly int $userId;

    public function __construct(DeleteTaskRequest $request)
    {
        $this->id     = $request->id;
        $this->userId = $request->user_id;
    }
}
