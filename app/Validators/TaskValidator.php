<?php

namespace App\Validators;

use App\DTO\TaskDTO;

class TaskValidator
{
    public function validate(TaskDTO $dto): void
    {
        $this->validateUserId($dto->userId);
        $this->validateTitle($dto->title);
        $this->validateDescription($dto->description);
        $this->validateTaskStatus($dto->taskStatus);
        $this->validateDeadline($dto->deadline);
    }

    public function index(TaskDTO $dto): void
    {
    }

    public function store(TaskDTO $dto): void
    {
    }

    public function update(TaskDTO $dto): void
    {
    }

    public function delete(TaskDTO $dto): void
    {
    }

    private function validateUserId(int $userId): void
    {
        if (is_null($userId)) {
            throw new \Exception('User ID can\'t be null.');
        }

        if ($userId < 0) {
            throw new \Exception('User ID can\'t be lower than 0.');
        }
    }

    private function validateTitle(string $title): void
    {
        if (empty($title)) {
            throw new \Exception('Title can\'t be empty.');
        }

        if (strlen($title) > 255) {
            throw new \Exception('Title can\'t be longer than 255 symbols.');
        }
    }

    private function validateDescription(string $description): void
    {
        if (empty($description)) {
            throw new \Exception('Description can\'t be empty.');
        }
    }

    private function validateTaskStatus(string $taskStatus): void
    {
        if (empty($taskStatus)) {
            throw new \Exception('Task status can\'t be empty.');
        }

        $valid_statuses = ['in_progress', 'completed', 'overdue'];
        if (!in_array($taskStatus, $valid_statuses)) {
            throw new \Exception('Task status is not valid.');
        }
    }

    private function validateDeadline(int $deadline): void
    {
        if (empty($deadline)) {
            throw new \Exception('Deadline can\'t be empty.');
        }

        $current_timestamp = time();
        if ($current_timestamp > $deadline) {
            throw new \Exception('Deadline can\' be less than current time.');
        }
    }
}
