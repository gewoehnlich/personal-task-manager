<?php

namespace App\Validators\Datatypes\MySQL\Enum;

use App\Validators\Datatypes\PHP\StringValidator;

class TaskStatus extends StringValidator
{
    public static function validate(
        string $taskStatus
    ): void {
        self::isNotNull(
            $taskStatus
        );
    }
}
