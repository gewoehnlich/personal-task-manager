<?php

namespace App\Ship\Values;

use App\Ship\Abstracts\Values\Value;
use App\Ship\Exceptions\IntegerValueIsLessThanMinValueException;
use App\Ship\Exceptions\IntegerValueIsMoreThanMaxValueException;
use App\Ship\Exceptions\RequiredValueIsNotPresentException;

abstract readonly class IntegerValue extends Value
{
    public const int MIN_VALUE = self::MIN_VALUE;

    public const int MAX_VALUE = self::MAX_VALUE;

    public function __construct(
        public readonly int $integer,
    ) {
        $this->validate();
    }

    public function value(): string
    {
        return $this->integer;
    }

    public static function from(
        ?int $integer,
    ): static {
        if ($integer === null) {
            throw new RequiredValueIsNotPresentException(
                entity: static::class,
            );
        }

        return new static(
            integer: $integer,
        );
    }

    public static function fromNullable(
        ?int $input,
    ): ?static {
        if ($input === null) {
            return null;
        }

        return self::from(
            integer: $input,
        );
    }

    protected function validate(): void
    {
        $this->isNotLessThanMinValue();

        $this->isNotMoreThanMaxValue();
    }

    private function isNotLessThanMinValue(): void
    {
        if ($this->integer < static::MIN_VALUE) {
            throw new IntegerValueIsLessThanMinValueException(
                integer: $this->integer,
                minValue: static::MIN_VALUE,
                entity: static::class,
            );
        }
    }

    private function isNotMoreThanMaxValue(): void
    {
        if ($this->integer > static::MAX_VALUE) {
            throw new IntegerValueIsMoreThanMaxValueException(
                integer: $this->integer,
                maxValue: static::MAX_VALUE,
                entity: static::class,
            );
        }
    }
}
