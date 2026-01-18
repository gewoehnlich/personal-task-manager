<?php

namespace App\Ship\Values;

use App\Ship\Abstracts\Values\Value;
use App\Ship\Exceptions\NotValidUuidException;
use Ramsey\Uuid\Rfc4122\UuidV7;

abstract readonly class UuidValue extends Value
{
    public function __construct(
        public readonly string $uuid,
    ) {
        $this->validate();
    }

    protected function validate(): void
    {
        $this->isValidUuid();
    }

    private function isValidUuid(): void
    {
        if (! UuidV7::isValid(uuid: $this->uuid)) {
            throw new NotValidUuidException(uuid: $this->uuid);
        }
    }
}
