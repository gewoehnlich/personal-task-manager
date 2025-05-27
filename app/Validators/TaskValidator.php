<?php

namespace App\Validators;

use Illuminate\Support\Facades\Auth;
use App\DTO\TaskDTO;
use App\Exceptions\Validation\Common\KeyNotFound;
use App\Exceptions\Validation\Common\MethodNotFound;
use App\Exceptions\Validation\Common\PropertyValueIsNull;
use App\Exceptions\Validation\BigIntUnsigned\UnsignedIntegerFieldValueIsZeroOrLess;
use App\Exceptions\Validation\Common\AuthorizedUserIdDoesNotEqualToInputtedUserId;
use App\Exceptions\Validation\Common\StringFieldIsEmpty;
use App\Exceptions\Validation\Varchar255\Varchar255FieldValueTooLong;
use App\Exceptions\Validation\Enum\NotValidTaskStatus;
use App\Exceptions\Validation\Timestamp\DeadlineTimestampLessThanCurrentTimestamp;

use App\Validators\Datatypes\PHP\Common;
use App\Validators\Datatypes\MySQL\Timestamp;
use App\Validators\Datatypes\MySQL\UnsignedInteger;
use App\Validators\Interfaces\ValidatorInterface;

class TaskValidator // implements ValidatorInterface
{
    private const array HASHMAP = [
        'id'           =>  'validateId',
        'userId'       =>  'validateUserId',
        'title'        =>  'validateTitle',
        'description'  =>  'validateDescription',
        'taskStatus'   =>  'validateTaskStatus',
        'deadline'     =>  'validateDeadline',
        'start'        =>  'validateStart',
        'end'          =>  'validateEnd'
    ];

    public static function validate(
        TaskDTO $dto
    ): void {
        $validator = new self();

        foreach ($dto::FIELDS as $key) {
            $method = self::HASHMAP[$key] ?? null;
            if (is_null($method)) {
                throw new KeyNotFound(
                    $key,
                    __CLASS__
                );
            }

            if (!method_exists($validator, $method)) {
                throw new MethodNotFound(
                    $method,
                    __CLASS__
                );
            }

            $validator->{$method}(
                $dto->{$key},
                $key
            );
        }
    }

    private function validateId(
        int $id,
        string $field
    ): void {

        Common::validate(
            $id,
            $field
        );

        UnsignedInteger::validate(
            $id,
            $field
        );
    }

    private function validateUserId(
        int $userId,
        string $field
    ): void {

        Common::validate(
            $userId,
            $field
        );

        UnsignedInteger::validate(
            $userId,
            $field
        );

        $authorizedUserId = Auth::id();
        if ($userId != $authorizedUserId) {
            throw new AuthorizedUserIdDoesNotEqualToInputtedUserId(
                $userId,
                $authorizedUserId
            );
        }
    }

    private function validateTitle(
        string $title,
        string $field
    ): void {

        Common::validate(
            $title,
            $field
        );

        if ($title === '') {
            throw new StringFieldIsEmpty(
                $field
            );
        }

        if (strlen($title) > 255) {
            throw new Varchar255FieldValueTooLong(
                $field
            );
        }
    }

    private function validateDescription(
        string $description,
        string $field
    ): void {

        Common::validate(
            $description,
            $field
        );

        if ($description === '') {
            throw new StringFieldIsEmpty(
                $field
            );
        }
    }

    private function validateTaskStatus(
        string $taskStatus,
        string $field
    ): void {

        Common::validate(
            $taskStatus,
            $field
        );

        $validStatuses = ['inProgress', 'completed', 'overdue'];
        if (!in_array($taskStatus, $validStatuses)) {
            throw new NotValidTaskStatus(
                $taskStatus,
                $validStatuses
            );
        }
    }

    private function validateDeadline(
        string $deadline,
        string $field
    ): void {

        Common::validate(
            $deadline,
            $field
        );

        Timestamp::validate($deadline);

        // finish this part later
        $current = time();
        if ($current > $deadline) {
            throw new DeadlineTimestampLessThanCurrentTimestamp(
                '\'deadline\' не может быть меньше, чем текущее время.'
            );
        }
    }

    private function validateStart(
        string $start,
        string $field
    ): void {

        Common::validate(
            $start,
            $field
        );

        /*$current = time();*/
        /*if ($current < $start) {*/
        /*    throw new \Exception(*/
        /*        'Start timestamp can\' be more than current time.'*/
        /*    );*/
        /*}*/
    }

    private function validateEnd(
        string $end,
        string $field
    ): void {

        Common::validate(
            $end,
            $field
        );

        /*$current = time();*/
        /*if ($current > $end) {*/
        /*    throw new \Exception(*/
        /*        'End timestamp can\' be more than current time.'*/
        /*    );*/
        /*}*/
    }
}
