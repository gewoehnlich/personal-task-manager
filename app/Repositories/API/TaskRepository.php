<?php

namespace App\Repositories\API;

use App\DTO\API\Tasks\TaskDTO;
use App\Http\Resources\TaskResource;
use App\Models\Task;

final class TaskRepository
{
    final public static function create(TaskDTO $dto): Task
    {
        $result = Task::create([
            'user_id'     => $dto->userId,
            'title'       => $dto->title,
            'description' => $dto->description,
            'stage'       => $dto->stage,
            'deadline'    => $dto->deadline,
        ]);

        return $result;
    }

    final public static function read(TaskDTO $dto): TaskResource
    {
        $result = Task::where('user_id', $dto->userId)->get();

        return new TaskResource($result);
    }

    final public static function update(TaskDTO $dto): bool
    {
        $task = Task::find($dto->id);

        $result = $task->update([
            'id'          => $dto->id,
            'user_id'     => $dto->userId,
            'title'       => $dto->title,
            'description' => $dto->description,
            'stage'       => $dto->stage,
            'deadline'    => $dto->deadline,
        ]);

        return $result;
    }

    final public static function delete(TaskDTO $dto): bool
    {
        $task   = Task::find($dto->id);
        $result = $task->delete();

        return $result;
    }
}
