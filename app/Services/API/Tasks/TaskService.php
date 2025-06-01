<?php

namespace App\Services\API\Tasks;

use App\Http\Requests\Api\Tasks\TaskRequests\CreateTaskRequest;
use App\Http\Requests\Api\Tasks\TaskRequests\ReadTaskRequest;
use App\Http\Requests\Api\Tasks\TaskRequests\UpdateTaskRequest;
use App\Http\Requests\Api\Tasks\TaskRequests\DeleteTaskRequest;
use App\DTO\TaskDTO\CreateTaskDTO;
use App\DTO\TaskDTO\ReadTaskDTO;
use App\DTO\TaskDTO\UpdateTaskDTO;
use App\DTO\TaskDTO\DeleteTaskDTO;
use App\Repositories\API\Tasks\TaskRepository;
use App\Services\Service;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Task;

abstract class TaskService // extends Service
{
    public static function create(
        CreateTaskRequest $request
    ): Task {
        $dto = CreateTaskDTO::fromRequest($request);
        $result = TaskRepository::create($dto);

        return $result;
    }

    public static function read(
        ReadTaskRequest $request
    ): JsonResource {
        $dto = ReadTaskDTO::fromRequest($request);
        $result = TaskRepository::read($dto);

        return $result;
    }

    public static function update(
        UpdateTaskRequest $request
    ): bool {
        $dto = UpdateTaskDTO::fromRequest($request);
        $result = TaskRepository::update($dto);

        return $result;
    }

    public static function delete(
        DeleteTaskRequest $request
    ): bool {
        $dto = DeleteTaskDTO::fromRequest($request);
        $result = TaskRepository::delete($dto);

        return $result;
    }
}
