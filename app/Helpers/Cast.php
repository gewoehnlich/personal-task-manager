<?php

namespace App\Helpers;

use App\Exceptions\Helpers\CastException;

class Cast
{
    public static function stringToInt(string $string): int
    {
        if (
            /*filter_var(*/
            /*    $string,*/
            /*    FILTER_VALIDATE_INT*/
            /*) === false*/

            /*!preg_match(*/
            /*    '/^-?\d+$/',*/
            /*    $string*/
            /*)*/
            !ctype_digit(
                $string
            )
        ) {
            throw new CastException(
                "Ошибка при попытки конвертации string {$string} в int."
            );
        }

        // take a string
        // if any letter or sign encountered, throw an error
        // if it starts with 0, ignore zeros
        // validate the number after all zeroes
        // '07' => 7

        $int = intval($string);

        return $int;
    }
}
