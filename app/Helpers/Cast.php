<?php

namespace App\Helpers;

use App\Exceptions\Helpers\CastException;

class Cast
{
    public static function stringToInt(string $string): int
    {
        if (
            filter_var(
                $string,
                FILTER_VALIDATE_INT
            ) === false
        ) {
            throw new CastException(
                "Ошибка при попытки конвертации string {$string} в int."
            );
        }

        $int = intval($string);

        return $int;
    }
}
