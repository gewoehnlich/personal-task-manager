<?php

namespace App\Services\API\Tasks;

use App\DTO\API\Tasks\CreateTaskDTO;
use App\DTO\API\Tasks\DeleteTaskDTO;
use App\DTO\API\Tasks\ReadTaskDTO;
use App\DTO\API\Tasks\TaskDTO;
use App\DTO\API\Tasks\UpdateTaskDTO;
use App\Http\Requests\API\Tasks\TaskRequests\CreateTaskRequest;
use App\Http\Requests\API\Tasks\TaskRequests\DeleteTaskRequest;
use App\Http\Requests\API\Tasks\TaskRequests\ReadTaskRequest;
use App\Http\Requests\API\Tasks\TaskRequests\UpdateTaskRequest;
use App\Models\Task;
use App\Repositories\API\Tasks\TaskRepository;
use App\Services\Service;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class TaskService // extends Service
{
    public static function create(
        CreateTaskRequest $request
    ): Task {
        $dto    = TaskDTO::fromRequest($request, CreateTaskDTO::class);
        $result = TaskRepository::create($dto);

        return $result;
    }

    public static function read(
        ReadTaskRequest $request
    ): JsonResource {
        $dto = TaskDTO::fromRequest($request, ReadTaskDTO::class);
        dd($dto);

        $result = TaskRepository::read($dto);

        return $result;
    }

    public static function update(
        UpdateTaskRequest $request
    ): bool {
        $dto    = TaskDTO::fromRequest($request, UpdateTaskDTO::class);
        $result = TaskRepository::update($dto);

        return $result;
    }

    public static function delete(
        DeleteTaskRequest $request
    ): bool {
        $dto    = TaskDTO::fromRequest($request, DeleteTaskDTO::class);
        $result = TaskRepository::delete($dto);

        return $result;
    }
}
