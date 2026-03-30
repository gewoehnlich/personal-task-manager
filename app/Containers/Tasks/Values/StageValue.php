<?php

namespace App\Containers\Tasks\Values;

use App\Containers\Tasks\Enums\StageEnum;
use App\Containers\Tasks\Exceptions\NoSuchStageValue;
use App\Ship\Abstracts\Values\Value;
use App\Ship\Exceptions\RequiredValueIsNotPresentException;

final readonly class StageValue extends Value
{
    public function __construct(
        public readonly StageEnum $stage,
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
                entity: self::class,
            );
        }

        $stage = StageEnum::tryFrom(
            value: $string,
        );

        if ($stage === null) {
            throw new NoSuchStageValue(
                value: $string,
            );
        }

        return new self(
            stage: StageEnum::tryFrom(
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
