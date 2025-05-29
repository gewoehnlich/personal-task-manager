<?php

namespace App\Validators\TaskFields;

use App\Validators\Datatypes\MySQL\TimestampValidator;

abstract class Start extends TimestampValidator
{
    public static function validate(
        string $start
    ): void {
        TimestampValidator::validate(
            $start
        );

        /*self::isStartTimestampLessThanCurrentTimestamp(*/
        /*    $start*/
        /*);*/
    }

    private static function isStartTimestampLessThanCurrentTimestamp(
        string $start
    ): void {
        $current = time();
        if ($current < $start) {
            throw new \Exception(
                'Start timestamp can\' be more than current time.'
            );
        }
    }
}
