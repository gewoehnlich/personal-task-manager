<?php

namespace App\Validators;

use Illuminate\Support\Facades\Auth;
use App\DTO\TaskDTO;
use App\Interfaces\Validators\ValidatorInterface;
use App\Validators\TaskFields\Id;
use App\Validators\TaskFields\UserId;
use App\Validators\TaskFields\Title;
use App\Validators\TaskFields\Description;
use App\Validators\TaskFields\TaskStatus;
use App\Validators\TaskFields\Deadline;
use App\Validators\TaskFields\Start;
use App\Validators\TaskFields\End;

abstract class TaskValidator implements ValidatorInterface
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
