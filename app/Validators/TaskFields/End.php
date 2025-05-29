<?php

namespace App\Validators\TaskFields;

use App\Validators\Datatypes\MySQL\TimestampValidator;

abstract class End extends TimestampValidator
{
    public static function validate(
        string $end
    ): void {
        TimestampValidator::validate(
            $end
        );
    }
}
