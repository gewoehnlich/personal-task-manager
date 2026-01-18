<?php

namespace App\Ship\Values;

use App\Ship\Abstracts\Values\Value;
use App\Ship\Exceptions\StringValueTooLongException;
use Illuminate\Support\Str;

abstract readonly class StringValue extends Value
{
    public const int MAX_LENGTH = self::MAX_LENGTH;

    public function __construct(
        public readonly string $string,
    ) {
        $this->validate();
    }

    protected function validate(): void
    {
        $this->isNotLongerThanMaxLength();
    }

    private function isNotLongerThanMaxLength(): void
    {
        if (Str::length(value: $this->string) > static::MAX_LENGTH) {
            throw new StringValueTooLongException(
                string: $this->string,
                entity: static::class,
            );
        }
    }
}
