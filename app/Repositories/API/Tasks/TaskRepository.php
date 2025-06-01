<?php

namespace App\Repositories\API\Tasks;

use App\DTO\TaskDTO;
use App\Models\Task;
use App\Http\Resources\TaskResource;

class TaskRepository
{
    public static function create(
        TaskDTO $dto
    ): Task {
        $result = Task::create([
            'userId'       =>  $dto->userId,
            'title'        =>  $dto->title,
            'description'  =>  $dto->description,
            'taskStatus'   =>  $dto->taskStatus,
            'deadline'     =>  $dto->deadline
        ]);

        return $result;
    }

    public static function read(
        TaskDTO $dto
    ): TaskResource {
        $result = Task::where('userId', $dto->userId)->get();
        return new TaskResource($result);
    }

    public static function update(
        TaskDTO $dto
    ): bool {
        $task = Task::find(
            $dto->id
        );

        $result = $task->update([
            'id'           =>  $dto->id,
            'userId'       =>  $dto->userId,
            'title'        =>  $dto->title,
            'description'  =>  $dto->description,
            'taskStatus'   =>  $dto->taskStatus,
            'deadline'     =>  $dto->deadline
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
