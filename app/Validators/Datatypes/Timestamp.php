<?php

namespace App\Validators\Datatypes;

use App\Validators\Interfaces\DatatypeInterface;

class Timestamp implements DatatypeInterface
{
    private const string MYSQL_TIMESTAMP_FORMAT = 'YYYY-MM-DD HH:MM:SS';
    private const string PHP_DATETIME_FORMAT = 'Y-m-d H:i:s';

    private string $timestamp;

    public function __construct(string $timestamp)
    {
        $this->timestamp = $timestamp;
    }

    public function validate()
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
                'Неправильный формат {$self::DATATYPE}.\n' .
                'Ожидаемый формат: {self::MYSQL_TIMESTAMP_FORMAT}'
            );
        }
    }
}
