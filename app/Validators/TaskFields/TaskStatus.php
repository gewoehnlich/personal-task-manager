<?php

namespace App\Validators\Datatypes\MySQL\Enum;

use App\Exceptions\Validation\Enum\NotValidTaskStatus;
use App\Validators\Datatypes\PHP\StringValidator;

abstract class TaskStatus extends StringValidator
{
    public static function validate(
        string $taskStatus
    ): void {
        TaskStatus::validate(
            $taskStatus
        );

        self::isValidStatus(
            $taskStatus
        );
    }

    private static function isValidStatus(
        string $taskStatus
    ): void {
        $validStatuses = ['inProgress', 'completed', 'overdue'];

        if (
            !in_array(
                $taskStatus,
                $validStatuses
            )
        ) {
            throw new NotValidTaskStatus(
                $taskStatus,
                $validStatuses
            );
        }
    }
}
