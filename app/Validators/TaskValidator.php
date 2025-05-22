<?php

namespace App\Validators;

use Illuminate\Support\Facades\Auth;
use App\DTO\TaskDTO;

class TaskValidator
{
    private const HASHMAP = [
        'id'              =>  'validateId',
        'userId'          =>  'validateUserId',
        'title'           =>  'validateTitle',
        'description'     =>  'validateDescription',
        'taskStatus'      =>  'validateTaskStatus',
        'deadline'        =>  'validateDeadline',
        'startTimestamp'  =>  'validateStartTimestamp',
        'endTimestamp'    =>  'validateEndTimestamp'
    ];

    public function validateIndexRequest(TaskDTO $dto): void
    {
        $this->validate($dto, $dto::KEYS_INDEX);
    }

    public function validateStoreRequest(TaskDTO $dto): void
    {
        $this->validate($dto, $dto::KEYS_STORE);
    }

    public function validateUpdateRequest(TaskDTO $dto): void
    {
        $this->validate($dto, $dto::KEYS_UPDATE);
    }

    public function validateDeleteRequest(TaskDTO $dto): void
    {
        $this->validate($dto, $dto::KEYS_DELETE);
    }

    private function validate(TaskDTO $dto, array $fields): void
    {
        foreach ($fields as $key) {
            $method = self::HASHMAP[$key] ?? null;
            if (is_null($method)) {
                throw new \Exception(
                    'Не найден метод для поля: {$key}'
                );
            }

            if (!method_exists($this, $method)) {
                throw new \Exception(
                    'Не найден метод {$method} в классе.'
                );
            }

            if (is_null($dto->{$key})) {
                throw new \Exception(
                    'Пустое поле {$key} в TaskDTO.'
                );
            }

            $this->{$method}($dto->{$key});
        }
    }

    private function validateId(int $id): void
    {
        if (is_null($id)) {
            throw new \Exception(
                'ID can\'t be null.'
            );
        }

        if ($id <= 0) {
            throw new \Exception(
                'ID can\'t be lower than or equal to 0.'
            );
        }
    }

    private function validateUserId(int $userId): void
    {
        if (is_null($userId)) {
            throw new \Exception(
                'User ID can\'t be null.'
            );
        }

        if ($userId <= 0) {
            throw new \Exception(
                'User ID can\'t be lower than or equal to 0.'
            );
        }

        if ($userId != Auth::id()) {
            throw new \Exception(
                'User IDs doesn\'t match!'
            );
        }
    }

    private function validateTitle(string $title): void
    {
        if (empty($title)) {
            throw new \Exception(
                'Title can\'t be empty.'
            );
        }

        if (strlen($title) > 255) {
            throw new \Exception(
                'Title can\'t be longer than 255 symbols.'
            );
        }
    }

    private function validateDescription(string $description): void
    {
        if (empty($description)) {
            throw new \Exception(
                'Description can\'t be empty.'
            );
        }
    }

    private function validateTaskStatus(string $taskStatus): void
    {
        if (empty($taskStatus)) {
            throw new \Exception(
                'Task status can\'t be empty.'
            );
        }

        $validStatuses = ['inProgress', 'completed', 'overdue'];
        if (!in_array($taskStatus, $validStatuses)) {
            throw new \Exception(
                'Task status is not valid.'
            );
        }
    }

    private function validateDeadline(int $deadline): void
    {
        if (empty($deadline)) {
            throw new \Exception(
                'Deadline can\'t be empty.'
            );
        }

        $currentTimestamp = time();
        if ($currentTimestamp > $deadline) {
            throw new \Exception(
                'Deadline can\' be less than current time.'
            );
        }
    }

    private function validateStartTimestamp(int $startTimestamp): void
    {
        if (empty($startTimestamp)) {
            throw new \Exception(
                'Start timestamp can\'t be empty.'
            );
        }

        $currentTimestamp = time();
        if ($currentTimestamp < $startTimestamp) {
            throw new \Exception(
                'Start timestamp can\' be more than current time.'
            );
        }
    }

    private function validateEndTimestamp(int $endTimestamp): void
    {
        if (empty($endTimestamp)) {
            throw new \Exception(
                'End timestamp can\'t be empty.'
            );
        }

        $currentTimestamp = time();
        if ($currentTimestamp > $endTimestamp) {
            throw new \Exception(
                'End timestamp can\' be more than current time.'
            );
        }
    }
}
