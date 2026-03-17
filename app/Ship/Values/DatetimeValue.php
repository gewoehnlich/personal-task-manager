<?php

namespace App\Ship\Values;

use App\Ship\Abstracts\Values\Value;
use App\Ship\Exceptions\DatetimeFormatHasToBeSetInConfigException;
use App\Ship\Exceptions\DatetimeFormatIsInvalidException;
use App\Ship\Exceptions\DatetimeValueInvalidInputStringException;
use App\Ship\Exceptions\RequiredValueIsNotPresentException;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Support\Carbon;

abstract readonly class DatetimeValue extends Value
{
    public function __construct(
        public readonly Carbon $carbon,
    ) {
        $this->validate();
    }

    public function value(): string
    {
        return $this->carbon->format(
            format: self::format(),
        );
    }

    public static function format(): string
    {
        if (config('datetime.format') === null) {
            throw new DatetimeFormatHasToBeSetInConfigException();
        }

        return config('datetime.format');
    }

    public static function from(
        ?string $value,
    ): static {
        if ($value === null) {
            throw new RequiredValueIsNotPresentException(
                entity: static::class,
            );
        }

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

        if ($datetime === false || $errors !== false) {
            throw new DatetimeValueInvalidInputStringException();
        }

        return new static(
            carbon: $datetime,
        );
    }

    public static function fromNullable(
        ?string $value,
    ): ?static {
        if ($value === null) {
            return null;
        }

        return self::from(
            value: $value,
        );
    }

    protected function validate(): void
    {
        //
    }
}
