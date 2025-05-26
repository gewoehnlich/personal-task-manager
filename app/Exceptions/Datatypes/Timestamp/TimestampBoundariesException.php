<?php

namespace App\Exceptions\Datatypes\Timestamp;

class TimestampBoundariesException extends TimestampException
{
    public function __construct(
        string $unit,
        int $lowerBoundary,
        int $upperBoundary
    ) {
        $message =
            "{$unit} не может быть " .
            "меньше {$lowerBoundary} и " .
            "больше {$upperBoundary}."
        ;

        parent::__construct($message);
    }
}
