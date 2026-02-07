<?php

namespace App\Ship\Values;

use App\Ship\Abstracts\Values\Value;
use App\Ship\Exceptions\DatetimeFormatIsInvalidException;
use App\Ship\Exceptions\DatetimeValueInvalidInputStringException;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Support\Carbon;

abstract readonly class DatetimeValue extends Value
{
    public function __construct(
        public readonly Carbon $carbon,
    ) {
        $this->validate();
    }

    protected function validate(): void
    {
        //
    }

    public static function format(): string
    {
        return config('datetime.format');
    }

    public static function from(
        string $value,
    ): static {
        try {
            $datetime = Carbon::createFromFormat(
                format: static::format(),
                time: $value,
                timezone: null,
            );
        } catch (InvalidFormatException $exception) {
            throw new DatetimeFormatIsInvalidException();
        }

        $errors = Carbon::getLastErrors();

        if (
            $datetime === false ||
            $errors['warning_count'] > 0 ||
            $errors['error_count'] > 0
        ) {
            throw new DatetimeValueInvalidInputStringException();
        }

        return new static(
            carbon: $datetime,
        );
    }
}
