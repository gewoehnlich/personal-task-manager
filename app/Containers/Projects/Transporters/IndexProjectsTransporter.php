<?php

namespace App\Containers\Projects\Transporters;

use App\Ship\Abstracts\Transporters\Transporter;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class IndexProjectsTransporter extends Transporter
{
    public function __construct(
        public readonly string $userUuid,
    ) {
        //
    }
}
