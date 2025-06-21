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
        $query = Task::query();

        if (!empty($dto->userId)) {
            $query->where('user_id', $dto->userId);
        }

        if (!empty($dto->id)) {
            $query->where('id', $dto->id);
        }

        if (!empty($dto->createdAtFrom)) {
            $query->where('created_at', '>=', $dto->createdAtFrom);
        }

        if (!empty($dto->createdAtTo)) {
            $query->where('created_at', '<=', $dto->createdAtTo);
        }

        if (!empty($dto->updatedAtFrom)) {
            $query->where('updated_at', '>=', $dto->updatedAtFrom);
        }

        if (!empty($dto->updatedAtTo)) {
            $query->where('updated_at', '<=', $dto->updatedAtTo);
        }

        if (!empty($dto->deadlineFrom)) {
            $query->where('deadline', '>=', $dto->deadlineFrom);
        }

        if (!empty($dto->deadlineTo)) {
            $query->where('deadline', '<=', $dto->deadlineTo);
        }

        if (!empty($dto->orderBy)) {
            $orderByField = $dto->orderByField ?? 'id';
            $query->orderBy($orderByField, $dto->orderBy);
        }

        if (!empty($dto->limit)) {
            $query->limit($dto->limit);
        }

        $result = $query->get();

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
