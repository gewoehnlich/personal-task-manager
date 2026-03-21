<?php

namespace App\Containers\Tasks\Values;

use App\Containers\Tasks\Enums\Stage;
use App\Containers\Tasks\Exceptions\NoSuchStageValue;
use App\Ship\Abstracts\Values\Value;
use App\Ship\Exceptions\RequiredValueIsNotPresentException;

final readonly class StageValue extends Value
{
    public function __construct(
        public readonly Stage $stage,
    ) {
        $this->validate();
    }

    public function value(): string
    {
        return $this->stage->value;
    }

    public static function from(
        ?string $string,
    ): static {
        if ($string === null) {
            throw new RequiredValueIsNotPresentException(
                entity: static::class,
            );
        }

        $stage = Stage::tryFrom(
            value: $string,
        );

        if ($stage === null) {
            throw new NoSuchStageValue(
                value: $string,
            );
        }

        return new static(
            stage: Stage::tryFrom(
                value: $string,
            ),
        );
    }

    public static function fromNullable(
        ?string $string,
    ): ?static {
        if ($string === null) {
            return null;
        }

        return self::from(
            string: $string,
        );
    }

    protected function validate(): void
    {
        //
    }
}
