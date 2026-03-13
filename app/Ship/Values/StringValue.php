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

    public function value(): string
    {
        return $this->string;
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

    public static function from(
        string $string,
    ): static {
        return new static(
            string: $string,
        );
    }

    public static function fromNullable(
        ?string $input,
    ): static | null {
        if ($input === null) {
            return null;
        }

        return self::from(
            string: $input,
        );
    }
}
