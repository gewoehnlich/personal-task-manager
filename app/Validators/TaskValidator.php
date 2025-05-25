<?php

namespace App\Validators;

use Illuminate\Support\Facades\Auth;
use App\DTO\TaskDTO;
use App\Exceptions\Validation\Common\HashmapKeyNotFound;
use App\Exceptions\Validation\Common\MethodNotFound;
use App\Exceptions\Validation\Common\PropertyValueIsNull;
use App\Exceptions\Validation\BigIntUnsigned\UnsignedIntegerFieldValueIsZeroOrLess;
use App\Exceptions\Validation\Common\AuthorizedUserIdDoesNotEqualToInputtedUserId;
use App\Exceptions\Validation\Common\StringFieldIsEmpty;
use App\Exceptions\Validation\Varchar255\Varchar255FieldValueTooLong;
use App\Exceptions\Validation\Enum\NotValidTaskStatus;
use App\Exceptions\Validation\Timestamp\DeadlineTimestampLessThanCurrentTimestamp;

class TaskValidator
{
    private const HASHMAP = [
        'id'           =>  'validateId',
        'userId'       =>  'validateUserId',
        'title'        =>  'validateTitle',
        'description'  =>  'validateDescription',
        'taskStatus'   =>  'validateTaskStatus',
        'deadline'     =>  'validateDeadline',
        'start'        =>  'validateStart',
        'end'          =>  'validateEnd'
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
                throw new HashmapKeyNotFound(
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
            throw new UnsignedIntegerFieldValueIsZeroOrLess(
                '\'id\' не может быть меньше или равно 0.'
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
            throw new UnsignedIntegerFieldValueIsZeroOrLess(
                '\'userId\' не может быть меньше или равно 0.'
            );
        }

        /*if ($userId != Auth::id()) {*/
        /*    throw new AuthorizedUserIdDoesNotEqualToInputtedUserId(*/
        /*        '\'userId\' не соответствует ID авторизованного пользователя.'*/
        /*    );*/
        /*}*/
    }

    private function validateTitle(string $title): void
    {
        if (is_null($title)) {
            throw new PropertyValueIsNull(
                '\'title\' не может быть null.'
            );
        }

        if ($title === '') {
            throw new StringFieldIsEmpty(
                '\'title\' не может быть пустым.'
            );
        }

        if (strlen($title) > 255) {
            throw new Varchar255FieldValueTooLong(
                '\'title\' не может быть длиннее 255 символов.'
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

        if ($description === '') {
            throw new StringFieldIsEmpty(
                '\'description\' не может быть пустым.'
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

        $validStatuses = ['inProgress', 'completed', 'overdue'];
        if (!in_array($taskStatus, $validStatuses)) {
            throw new NotValidTaskStatus(
                '\'taskStatus\' значение {$taskStatus} неправильное.\n' .
                'Допустимые значения: {$validStatuses}.'
            );
        }
    }

    private function validateDeadline(string $deadline): void
    {
        if (is_null($deadline)) {
            throw new PropertyValueIsNull(
                '\'deadline\' не может быть null.'
            );
        }

        $current = time();
        if ($current > $deadline) {
            throw new DeadlineTimestampLessThanCurrentTimestamp(
                '\'deadline\' не может быть меньше, чем текущее время.'
            );
        }
    }

    private function validateStart(string $start): void
    {
        if (is_null($start)) {
            throw new PropertyValueIsNull(
                '\'start\' не может быть null.'
            );
        }

        /*$current = time();*/
        /*if ($current < $start) {*/
        /*    throw new \Exception(*/
        /*        'Start timestamp can\' be more than current time.'*/
        /*    );*/
        /*}*/
    }

    private function validateEnd(string $end): void
    {
        if (is_null($end)) {
            throw new PropertyValueIsNull(
                '\'end\' не может быть null.'
            );
        }

        /*$current = time();*/
        /*if ($current > $end) {*/
        /*    throw new \Exception(*/
        /*        'End timestamp can\' be more than current time.'*/
        /*    );*/
        /*}*/
    }
}
