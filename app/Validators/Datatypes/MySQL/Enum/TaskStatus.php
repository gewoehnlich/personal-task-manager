<?php

namespace App\Validators\Datatypes\MySQL\Enum;

use App\Validators\Datatypes\PHP\Common;
use App\Exceptions\Validation\Enum\NotValidTaskStatus;
use App\Interfaces\Validators\Datatypes\DatatypeValidatorInterfaces\{
    StringDatatypeValidatorInterface
};

class TaskStatus implements StringDatatypeValidatorInterface
{
    public static function validate(
        string $taskStatus,
        string $field
    ): void {
        Common::isNotNull(
            $taskStatus,
            $field
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
