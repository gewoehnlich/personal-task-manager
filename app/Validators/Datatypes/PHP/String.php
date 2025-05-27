<?php

namespace App\Validators\Datatypes\PHP;

use App\Exceptions\Validation\Common\StringFieldValueIsEmpty;
use App\Interfaces\Validators\Datatypes\DatatypeValidatorInterfaces\{
    StringDatatypeValidatorInterface
};
use App\Exceptions\Validation\Varchar255\Varchar255FieldValueTooLong;
use App\Exceptions\Validation\Text\TextFieldValueTooLong;

class Str implements StringDatatypeValidatorInterface
{
    public static function validate(
        string $value,
        string $field
    ) {
        self::isNotEmpty(
            $value,
            $field
        );

        if ($field == 'title') {
            self::isLengthLessOrEqualTo255(
                $value,
                $field
            );
        }

        if ($field == 'description') {
            self::isLengthLessOrEqualTo65535(
                $value,
                $field
            );
        }
    }

    private static function isNotEmpty(
        string $value,
        string $field
    ) {
        if ($value === '') {
            throw new StringFieldValueIsEmpty(
                $field
            );
        }
    }

    private static function isLengthLessOrEqualTo255(
        string $value,
        string $field
    ) {
        if (strlen($value) > 255) {
            throw new Varchar255FieldValueTooLong(
                $field
            );
        }
    }

    private static function isLengthLessOrEqualTo65535(
        string $value,
        string $field
    ) {
        if (strlen($value) > 65535) {
            throw new TextFieldValueTooLong(
                $field
            );
        }
    }
}
