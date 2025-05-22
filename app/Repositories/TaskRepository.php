<?php

namespace App\Repositories;

use PDO;
use App\Core\Database;
use App\DTO\TaskDTO;

class TaskRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function create(TaskDTO $dto): ?array
    {
        $stmt = $this->db->prepare("
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

        return $this->findById($this->db->lastInsertId());
    }

    public function read(TaskDTO $dto): ?array
    {
        $stmt = $this->db->prepare("
            SELECT * FROM tasks
            WHERE userId = :userId
        ");

        $stmt->execute([
            ':userId' => $dto->userId,
            /*':startTimestamp' => $dto->startTimestamp,*/
            /*':endTimestamp' => $dto->endTimestamp,*/
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update(TaskDTO $dto): ?array
    {
        $stmt = $this->db->prepare("
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

        return $this->findById($dto->id);
    }

    public function delete(TaskDTO $dto): bool
    {
        $stmt = $this->db->prepare("
            DELETE FROM tasks
            WHERE id = :id
        ");

        return $stmt->execute([
            ':id' => $dto->id,
            /*':userId' => $dto->userId,*/
        ]);
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}
