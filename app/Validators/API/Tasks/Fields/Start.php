<?php

namespace App\Validators\API\Tasks\Fields;

use App\Validators\Datatypes\MySQL\TimestampValidator;

abstract class Start extends TimestampValidator
{
    public static function validate(
        string $start
    ): void {
        TimestampValidator::validate(
            $start
        );
    }
}
