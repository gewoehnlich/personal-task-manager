<?php

namespace App\DTO\API\Tasks;

use App\DTO\API\APIDTO;
use App\Http\Requests\API\Tasks\TaskRequest;

abstract class TaskDTO extends APIDTO
{
    final public static function fromRequest(
        TaskRequest $request,
        string $class
    ): TaskDTO {
        $dto = new $class($request);

        return $dto;
    }
}
