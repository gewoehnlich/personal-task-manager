<?php

namespace App\Validators\Datatypes\PHP;

use App\Exceptions\Validation\Common\PropertyValueIsNull;

class Common
{
    public static function validate(
        mixed $value,
        string $field
    ) {
        self::isNotNull(
            $value,
            $field
        );
    }

    private static function isNotNull(
        mixed $value,
        string $field
    ) {
        if (is_null($value)) {
            throw new PropertyValueIsNull(
                $field
            );
        }
    }
}
