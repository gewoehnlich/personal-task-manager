<?php

namespace App\Validators\Datatypes\MySQL;

use App\Validators\Datatypes\DatatypeValidator;
use App\Exceptions\Datatypes\Timestamp\TimestampBoundariesException;
use App\Helpers\Cast;

class TimestampValidator extends DatatypeValidator
{
    private const string MYSQL_TIMESTAMP_FORMAT = 'YYYY-MM-DD HH:MM:SS';
    private const string PHP_DATETIME_FORMAT    = 'Y-m-d H:i:s';

    public static function validate(
        string $timestamp
    ): void {
        self::isNotNull(
            $timestamp
        );

        self::isMySQLTimestampFormatValid(
            $timestamp
        );

        self::isDateTimeValid(
            $timestamp
        );
    }

    private static function isMySQLTimestampFormatValid(
        string $timestamp
    ): void {
        $isValid = preg_match(
            '/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/',
            $timestamp
        ) === 1;

        if (!$isValid) {
            throw new \Exception(
                "Неправильный формат {$timestamp}.\n" .
                "Ожидаемый формат: {self::MYSQL_TIMESTAMP_FORMAT}"
            );
        }
    }

    private static function isDateTimeValid(
        string $timestamp
    ): void {
        $date = \DateTime::createFromFormat(
            self::PHP_DATETIME_FORMAT,
            $timestamp
        );

        $errors = \DateTime::getLastErrors();

        if (
            $date === false // ||
            /*$errors['warning_count'] > 0 ||*/
            /*$errors['error_count'] > 0*/
        ) {
            throw new \Exception(
                "Неправильный формат TIMESTAMP {$timestamp}.\n" .
                "Ожидаемый формат: {self::PHP_DATETIME_FORMAT}"
            );
        }

        // find a way to catch an error over here;
        $year    = $date->format('Y');
        $month   = $date->format('n');
        $day     = $date->format('j');
        $hours   = $date->format('G');
        $minutes = $date->format('i');
        $seconds = $date->format('s');

        self::validateYear($year);
        self::validateMonth($month);
        self::validateDay($day);
        self::validateHours($hours);
        self::validateMinutes($minutes);
        self::validateSeconds($seconds);
    }

    private static function validateYear(
        string $year
    ): void {
        $unit          = 'year';
        $lowerBoundary = 1970;
        $upperBoundary = 2038;

        $year = Cast::stringToInt($year);

        if (
            $year < $lowerBoundary ||
            $year > $upperBoundary
        ) {
            throw new TimestampBoundariesException(
                $unit,
                $lowerBoundary,
                $upperBoundary
            );
        }
    }

    private static function validateMonth(
        string $month
    ): void {
        $unit          = 'month';
        $lowerBoundary = 1;
        $upperBoundary = 12;

        $month = Cast::stringToInt($month);

        if (
            $month < $lowerBoundary ||
            $month > $upperBoundary
        ) {
            throw new TimestampBoundariesException(
                $unit,
                $lowerBoundary,
                $upperBoundary
            );
        }
    }

    private static function validateDay(
        string $day
    ): void {
        $unit          = 'day';
        $lowerBoundary = 1;
        $upperBoundary = 31;

        $day = Cast::stringToInt($day);

        if (
            $day < $lowerBoundary ||
            $day > $upperBoundary
        ) {
            throw new TimestampBoundariesException(
                $unit,
                $lowerBoundary,
                $upperBoundary
            );
        }
    }

    private static function validateHours(
        string $hours
    ): void {
        $unit          = 'hours';
        $lowerBoundary = 0;
        $upperBoundary = 23;

        $hours = Cast::stringToInt($hours);

        if (
            $hours < $lowerBoundary ||
            $hours > $upperBoundary
        ) {
            throw new TimestampBoundariesException(
                $unit,
                $lowerBoundary,
                $upperBoundary
            );
        }
    }

    private static function validateMinutes(
        string $minutes
    ): void {
        $unit          = 'minutes';
        $lowerBoundary = 0;
        $upperBoundary = 59;

        $minutes = Cast::stringToInt($minutes);

        if (
            $minutes < $lowerBoundary ||
            $minutes > $upperBoundary
        ) {
            throw new TimestampBoundariesException(
                $unit,
                $lowerBoundary,
                $upperBoundary
            );
        }
    }

    private static function validateSeconds(
        string $seconds
    ): void {
        $unit          = 'seconds';
        $lowerBoundary = 0;
        $upperBoundary = 59;

        $seconds = Cast::stringToInt($seconds);

        if (
            $seconds < $lowerBoundary ||
            $seconds > $upperBoundary
        ) {
            throw new TimestampBoundariesException(
                $unit,
                $lowerBoundary,
                $upperBoundary
            );
        }
    }
}
