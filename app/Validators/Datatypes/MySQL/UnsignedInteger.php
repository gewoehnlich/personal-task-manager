<?php

namespace App\Validators\Datatypes\MySQL;

use App\Validators\Datatypes\PHP\Common;
use App\Exceptions\Validation\BigIntUnsigned\{
    UnsignedIntegerFieldValueIsLessThanZero,
    UnsignedIntegerFieldValueIsEqualToZero
};

class UnsignedInteger
{
    public static function validate(
        int $value,
        string $field
    ): void {
        Common::isNotNull(
            $value,
            $field
        );

        self::isNotLowerThanZero(
            $value,
            $field
        );

        if (
            in_array(
                $field,
                [
                    'id',
                    'userId'
                ],
                true
            )
        ) {
            self::isNotEqualToZero(
                $value,
                $field
            );
        }
    }

    private static function isNotLowerThanZero(
        int $value,
        string $field
    ): void {
        if ($value < 0) {
            throw new UnsignedIntegerFieldValueIsLessThanZero(
                $field
            );
        }
    }

    private static function isNotEqualToZero(
        int $value,
        string $field
    ): void {
        if ($value === 0) {
            throw new UnsignedIntegerFieldValueIsEqualToZero(
                $field
            );
        }
    }
}
