<?php

namespace App\Validators;

use Illuminate\Support\Facades\Auth;
use App\DTO\TaskDTO;
use App\Exceptions\Validation\KeyNotFoundInHashmap;
use App\Exceptions\Validation\MethodNotFound;
use App\Exceptions\Validation\PropertyValueIsNull;

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
                throw new KeyNotFoundInHashmap(
                    'Не найден ключ {$key} ' .
                    'в SELF::HASHMAP в классе {__CLASS__}.'
                );
            }

            if (!method_exists($this, $method)) {
                throw new MethodNotFound(
                    'Не найден метод {$method} в классе {__CLASS__}.\n' .
                    'Проверьте правильность указанного метода ' .
                    'в self::HASHMAP для поля {$key}.'
                );
            }

            $this->{$method}($dto->{$key});
        }
    }

    private function validateId(int $id): void
    {
        if (is_null($id)) {
            throw new PropertyValueIsNull(
                '\'id\' не может быть null.'
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
            throw new PropertyValueIsNull(
                '\'userId\' не может быть null.'
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
        if (is_null($title)) {
            throw new PropertyValueIsNull(
                '\'title\' не может быть null.'
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
        if (is_null($description)) {
            throw new PropertyValueIsNull(
                '\'description\' не может быть null.'
            );
        }

        if (empty($description)) {
            throw new \Exception(
                'Description can\'t be empty.'
            );
        }
    }

    private function validateTaskStatus(string $taskStatus): void
    {
        if (is_null($taskStatus)) {
            throw new PropertyValueIsNull(
                '\'taskStatus\' не может быть null.'
            );
        }

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
        if (is_null($deadline)) {
            throw new PropertyValueIsNull(
                '\'deadline\' не может быть null.'
            );
        }

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
        if (is_null($startTimestamp)) {
            throw new PropertyValueIsNull(
                '\'startTimestamp\' не может быть null.'
            );
        }

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
        if (is_null($endTimestamp)) {
            throw new PropertyValueIsNull(
                '\'endTimestamp\' не может быть null.'
            );
        }

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
