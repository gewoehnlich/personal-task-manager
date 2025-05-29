<?php

namespace App\Validators\TaskFields;

use App\Validators\Datatypes\MySQL\UnsignedInteger;
use App\Exceptions\Validation\BigIntUnsigned\{
    UnsignedIntegerFieldValueIsEqualToZero
};

abstract class Id extends UnsignedInteger
{
    public static function validate(
        int $id
    ): void {
        UnsignedInteger::validate(
            $id
        );

        self::isNotEqualToZero(
            $id
        );
    }

    private static function isNotEqualToZero(
        int $id
    ): void {
        if ($id === 0) {
            throw new UnsignedIntegerFieldValueIsEqualToZero();
        }
    }
}
