<?php

namespace App\Validators\API\Tasks\Fields;

use App\Validators\Datatypes\MySQL\UnsignedIntegerValidator;
use App\Exceptions\Validation\BigIntUnsigned\{
    UnsignedIntegerFieldValueIsEqualToZero
};

abstract class Id extends UnsignedIntegerValidator
{
    public static function validate(
        int $id
    ): void {
        UnsignedIntegerValidator::validate(
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
