<?php

namespace App\Repositories\API\Tasks;

use App\DTO\TaskDTO;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskRepository
{
    public static function create(
        TaskDTO $dto
    ): Task {
        $result = Task::create([
            'user_id' => $dto->userId,
            'title' => $dto->title,
            'description' => $dto->description,
            'stage' => $dto->taskStatus,
            'deadline' => $dto->deadline,
        ]);

        return $result;
    }

    public static function read(
        TaskDTO $dto
    ): TaskResource {
        $result = Task::where('user_id', $dto->userId)->get();

        return new TaskResource($result);
    }

    public static function update(
        TaskDTO $dto
    ): bool {
        $task = Task::find(
            $dto->id
        );

        $result = $task->update([
            'id' => $dto->id,
            'user_id' => $dto->userId,
            'title' => $dto->title,
            'description' => $dto->description,
            'stage' => $dto->taskStatus,
            'deadline' => $dto->deadline,
        ]);

        return $result;
    }

    public static function delete(
        TaskDTO $dto
    ): bool {
        $task = Task::find(
            $dto->id
        );

        $result = $task->delete();

        return $result;
    }
}
