<?php

namespace App\Containers\Projects\Transporters;

use App\Ship\Parents\Transporters\Transporter;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class IndexProjectTransporter extends Transporter
{
    public function __construct(
        public readonly string $userUuid,
    ) {
        //
    }
}
