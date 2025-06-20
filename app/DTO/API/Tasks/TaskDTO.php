<?php

namespace App\DTO\API\Tasks;

use App\Http\Requests\Api\Tasks\TaskRequest;

abstract class TaskDTO
{
    final public static function fromRequest(
        TaskRequest $request,
        string $class
    ): TaskDTO {
        $dto = new $class($request);

        return $dto;
    }
}
