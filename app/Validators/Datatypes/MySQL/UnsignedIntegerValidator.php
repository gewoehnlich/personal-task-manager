<?php

namespace App\Validators\Datatypes\MySQL;

use App\Validators\Datatypes\PHP\IntValidator;
use App\Exceptions\Validation\BigIntUnsigned\{
    UnsignedIntegerFieldValueIsLessThanZero
};

abstract class UnsignedIntegerValidator extends IntValidator
{
    public static function validate(
        int $value
    ): void {
        self::isNotNull(
            $value
        );

        self::isNotLowerThanZero(
            $value
        );
    }

    protected static function isNotLowerThanZero(
        int $value
    ): void {
        if ($value < 0) {
            throw new UnsignedIntegerFieldValueIsLessThanZero();
        }
    }
}
