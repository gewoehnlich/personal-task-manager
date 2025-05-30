<?php

namespace App\Repositories\API\Tasks;

use PDO;
use App\Core\Database;
use App\DTO\TaskDTO;
use App\Models\Task;
use App\Http\Resources\TaskResource;

class TaskRepository
{
    public static function create(
        TaskDTO $dto
    ): ?array {
        $db = Database::getConnection();

        $stmt = $db->prepare("
            INSERT INTO tasks (
                userId,
                title,
                description,
                taskStatus,
                deadline
            ) VALUES (
                :userId,
                :title,
                :description,
                :taskStatus,
                :deadline
            )
        ");

        $stmt->execute([
            ':userId' => $dto->userId,
            ':title' => $dto->title,
            ':description' => $dto->description,
            ':taskStatus' => $dto->taskStatus,
            ':deadline' => $dto->deadline
        ]);

        return self::findById($db->lastInsertId());
    }

    public static function read(
        TaskDTO $dto
    ): TaskResource {
        $result = Task::all();
        return new TaskResource($result);
    }

    public static function update(TaskDTO $dto): ?array
    {
        $db = Database::getConnection();

        $stmt = $db->prepare("
            UPDATE tasks
            SET userId = :userId,
                title = :title,
                description = :description,
                taskStatus = :taskStatus,
                deadline = :deadline
            WHERE id = :id
        ");

        $stmt->execute([
            ':id' => $dto->id,
            ':userId' => $dto->userId,
            ':title' => $dto->title,
            ':description' => $dto->description,
            ':taskStatus' => $dto->taskStatus,
            ':deadline' => $dto->deadline
        ]);

        return self::findById($dto->id);
    }

    public static function delete(TaskDTO $dto): bool
    {
        $db = Database::getConnection();

        $stmt = $db->prepare("
            DELETE FROM tasks
            WHERE id = :id
        ");

        return $stmt->execute([
            ':id' => $dto->id,
        ]);
    }

    public static function findById(int $id): ?array
    {
        $db = Database::getConnection();

        $stmt = $db->prepare(
            "SELECT * FROM tasks WHERE id = :id"
        );

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}
