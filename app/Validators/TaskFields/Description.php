<?php

namespace App\Validators\TaskFields;

use App\Validators\Datatypes\PHP\StringValidator;
use App\Exceptions\Validation\Text\TextFieldValueTooLong;

abstract class Description extends StringValidator
{
    public static function validate(
        string $description
    ): void {
        StringValidator::validate(
            $description
        );

        self::isLengthLessOrEqualTo65535(
            $description
        );
    }

    private static function isLengthLessOrEqualTo65535(
        string $description
    ): void {
        if (strlen($description) > 65535) {
            throw new TextFieldValueTooLong();
        }
    }
}
