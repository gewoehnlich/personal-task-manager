<?php

namespace App\Containers\Projects\Transporters;

use App\Ship\Abstracts\Transporters\Transporter;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class UpdateProjectTransporter extends Transporter
{
    public function __construct(
        public readonly string $uuid,
        public readonly string $userUuid,
        public readonly ?string $name,
        public readonly ?string $description,
    ) {
        //
    }
}
