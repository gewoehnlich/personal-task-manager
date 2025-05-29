<?php

namespace App\Validators\API\Tasks;

use App\DTO\TaskDTO;
use App\Validators\Validator;
use App\Validators\API\Tasks\Fields\Id;
use App\Validators\API\Tasks\Fields\UserId;
use App\Validators\API\Tasks\Fields\Title;
use App\Validators\API\Tasks\Fields\Description;
use App\Validators\API\Tasks\Fields\TaskStatus;
use App\Validators\API\Tasks\Fields\Deadline;
use App\Validators\API\Tasks\Fields\Start;
use App\Validators\API\Tasks\Fields\End;
use App\Exceptions\Validation\Common\KeyNotFound;
use App\Exceptions\Validation\Common\MethodNotFound;

abstract class TaskValidator extends Validator
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
        foreach ($dto::FIELDS as $key) {
            $method = self::HASHMAP[$key] ?? null;
            if (is_null($method)) {
                throw new KeyNotFound(
                    $key,
                    __CLASS__
                );
            }

            if (!method_exists(self::class, $method)) {
                throw new MethodNotFound(
                    $method,
                    __CLASS__
                );
            }

            self::{$method}(
                $dto->{$key}
            );
        }
    }

    private static function validateId(
        int $id
    ): void {
        Id::validate(
            $id
        );
    }

    private static function validateUserId(
        int $userId
    ): void {
        UserId::validate(
            $userId
        );
    }

    private static function validateTitle(
        string $title
    ): void {
        Title::validate(
            $title
        );
    }

    private static function validateDescription(
        string $description
    ): void {
        Description::validate(
            $description
        );
    }

    private static function validateTaskStatus(
        string $taskStatus
    ): void {
        TaskStatus::validate(
            $taskStatus
        );
    }

    private static function validateDeadline(
        string $deadline
    ): void {
        Deadline::validate(
            $deadline
        );
    }

    private static function validateStart(
        string $start
    ): void {
        Start::validate(
            $start
        );
    }

    private static function validateEnd(
        string $end
    ): void {
        End::validate(
            $end
        );
    }
}
