<?php

namespace App\Ship\Values;

use App\Ship\Abstracts\Values\Value;
use App\Ship\Exceptions\DatetimeValueInvalidInputStringException;
use Illuminate\Support\Carbon;

abstract readonly class DatetimeValue extends Value
{
    public const string FORMAT = Carbon::ATOM;

    public function __construct(
        public readonly Carbon $carbon,
    ) {
        $this->validate();
    }

    protected function validate(): void
    {
        //
    }

    public static function from(
        string $value,
    ): static {
        $datetime = Carbon::createFromFormat(
            format: self::FORMAT,
            time: $value,
            timezone: null,
        );

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
