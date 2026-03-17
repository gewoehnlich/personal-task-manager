<?php

namespace App\Ship\Values;

use App\Ship\Abstracts\Values\Value;
use App\Ship\Exceptions\RequiredValueIsNotPresentException;
use App\Ship\Exceptions\StringValueIsTooLongException;
use Illuminate\Support\Str;

abstract readonly class StringValue extends Value
{
    public const int MAX_LENGTH = self::MAX_LENGTH;

    public function __construct(
        public readonly string $string,
    ) {
        $this->validate();
    }

    public function value(): string
    {
        return $this->string;
    }

    public static function from(
        ?string $string,
    ): static {
        if ($string === null) {
            throw new RequiredValueIsNotPresentException(
                entity: static::class,
            );
        }

        return new static(
            string: $string,
        );
    }

    public static function fromNullable(
        ?string $input,
    ): ?static {
        if ($input === null) {
            return null;
        }

        return self::from(
            string: $input,
        );
    }

    protected function validate(): void
    {
        $this->isNotLongerThanMaxLength();
    }

    private function isNotLongerThanMaxLength(): void
    {
        if (Str::length(value: $this->string) > static::MAX_LENGTH) {
            throw new StringValueIsTooLongException(
                string: $this->string,
                entity: static::class,
            );
        }
    }
}
