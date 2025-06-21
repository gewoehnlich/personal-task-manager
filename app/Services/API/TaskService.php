<?php

namespace App\Services\API;

use App\DTO\API\Tasks\CreateTaskDTO;
use App\DTO\API\Tasks\DeleteTaskDTO;
use App\DTO\API\Tasks\ReadTaskDTO;
use App\DTO\API\Tasks\TaskDTO;
use App\DTO\API\Tasks\UpdateTaskDTO;
use App\Http\Requests\API\Tasks\CreateTaskRequest;
use App\Http\Requests\API\Tasks\DeleteTaskRequest;
use App\Http\Requests\API\Tasks\ReadTaskRequest;
use App\Http\Requests\API\Tasks\UpdateTaskRequest;
use App\Models\Task;
use App\Repositories\API\Tasks\TaskRepository;
use Illuminate\Http\Resources\Json\JsonResource;

final class TaskService extends APIService
{
    final public static function create(CreateTaskRequest $request): Task
    {
        $dto    = TaskDTO::fromRequest($request, CreateTaskDTO::class);
        $result = TaskRepository::create($dto);

        return $result;
    }

    final public static function read(ReadTaskRequest $request): JsonResource
    {
        $dto    = TaskDTO::fromRequest($request, ReadTaskDTO::class);
        $result = TaskRepository::read($dto);

        return $result;
    }

    final public static function update(UpdateTaskRequest $request): bool
    {
        $dto    = TaskDTO::fromRequest($request, UpdateTaskDTO::class);
        $result = TaskRepository::update($dto);

        return $result;
    }

    final public static function delete(DeleteTaskRequest $request): bool
    {
        $dto    = TaskDTO::fromRequest($request, DeleteTaskDTO::class);
        $result = TaskRepository::delete($dto);

        return $result;
    }
}
