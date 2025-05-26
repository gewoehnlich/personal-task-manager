<?php

namespace App\Validators\Datatypes;

use App\Validators\Interfaces\DatatypeValidatorInterface;
use App\Exceptions\Datatypes\Timestamp\TimestampBoundariesException;
use App\Helpers\Cast;

class Timestamp implements DatatypeValidatorInterface
{
    private const string MYSQL_TIMESTAMP_FORMAT = 'YYYY-MM-DD HH:MM:SS';
    private const string PHP_DATETIME_FORMAT    = 'Y-m-d H:i:s';

    private string $timestamp;

    public function __construct(string $timestamp)
    {
        $this->timestamp = $timestamp;
    }

    public static function validate()
    {
        $this->isMySQLTimestampFormatValid();
        $this->isDateTimeValid();
    }

    private function isMySQLTimestampFormatValid(): void
    {
        $isValid = preg_match(
            '/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/',
            $this->timestamp
        ) === true;

        if (!$isValid) {
            throw new \Exception(
                'Неправильный формат {self::DATATYPE}.\n' .
                'Ожидаемый формат: {self::MYSQL_TIMESTAMP_FORMAT}'
            );
        }
    }

    private function isDateTimeValid(): void
    {
        $date = \DateTime::createFromFormat(
            self::PHP_DATETIME_FORMAT,
            $this->timestamp
        );

        $errors = \DateTime::getLastErrors();

        if (
            $date === false ||
            $errors['warning_count'] > 0 ||
            $errors['error_count'] > 0
        ) {
            throw new \Exception(
                'Неправильный формат TIMESTAMP.\n' .
                'Ожидаемый формат: {self::PHP_DATETIME_FORMAT}'
            );
        }

        // find a way to catch an error over here;
        $year    = $date->format('Y');
        $month   = $date->format('n');
        $day     = $date->format('j');
        $hours   = $date->format('G');
        $minutes = $date->format('i');
        $seconds = $date->format('s');

        $this->validateYear($year);
        $this->validateMonth($month);
        $this->validateDay($day);
        $this->validateHours($hours);
        $this->validateMinutes($minutes);
        $this->validateSeconds($seconds);
    }

    private function validateYear(string $year): void
    {
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

    private function validateMonth(string $month): void
    {
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

    private function validateDay(string $day): void
    {
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

    private function validateHours(string $hours): void
    {
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

    private function validateMinutes(string $minutes): void
    {
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

    private function validateSeconds(string $seconds): void
    {
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
