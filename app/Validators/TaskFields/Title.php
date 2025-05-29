<?php

namespace App\Validators\TaskFields;

use App\Validators\Datatypes\PHP\StringValidator;
use App\Exceptions\Validation\Varchar255\Varchar255FieldValueTooLong;

abstract class Title extends StringValidator
{
    public static function validate(
        string $title
    ): void {
        StringValidator::validate(
            $title
        );

        self::isLengthLessOrEqualTo255(
            $title
        );
    }

    private static function isLengthLessOrEqualTo255(
        string $title
    ): void {
        if (strlen($title) > 255) {
            throw new Varchar255FieldValueTooLong();
        }
    }
}
