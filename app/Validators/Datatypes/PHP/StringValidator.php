<?php

namespace App\Validators\Datatypes\PHP;

use App\AbstractClasses\Validators\Datatypes\DatatypeValidator;
use App\Exceptions\Validation\Common\StringFieldValueIsEmpty;

class StringValidator extends DatatypeValidator
{
    public static function validate(
        string $value
    ): void {
        self::isNotNull(
            $value
        );

        self::isNotEmpty(
            $value
        );
    }

    public static function isNotEmpty(
        string $value
    ): void {
        if ($value === '') {
            throw new StringFieldValueIsEmpty();
        }
    }
}
