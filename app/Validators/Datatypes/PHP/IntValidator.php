<?php

namespace App\Validators\Datatypes\PHP;

use App\Validators\Datatypes\DatatypeValidator;

abstract class IntValidator extends DatatypeValidator
{
    public static function validate(
        int $value
    ): void {
        self::isNotNull(
            $value
        );
    }
}
