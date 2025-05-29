<?php

namespace App\Validators\TaskFields;

use App\Validators\Datatypes\MySQL\TimestampValidator;
use App\Exceptions\Validation\Timestamp\{
    DeadlineTimestampLessThanCurrentTimestamp
};

abstract class Deadline extends TimestampValidator
{
    public static function validate(
        string $deadline
    ): void {
        TimestampValidator::validate(
            $deadline
        );

        self::isDeadlineLaterThanCurrentTimestamp(
            $deadline
        );
    }

    private static function isDeadlineLaterThanCurrentTimestamp(
        string $deadline
    ): void {
        $current = time();
        if ($current > $deadline) {
            throw new DeadlineTimestampLessThanCurrentTimestamp(
                '\'deadline\' не может быть меньше, чем текущее время.'
            );
        }
    }
}
