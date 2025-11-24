<?php

namespace App\Containers\Projects\Transporters;

use App\Ship\Parents\Transporters\Transporter;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class CreateProjectTransporter extends Transporter
{
    public function __construct(
        public readonly int $userId,
        public readonly string $name,
        public readonly ?string $description,
        public readonly ?bool $deleted,
    ) {
        //
    }
}
