<?php

namespace App\Containers\Projects\Dto;

use App\Ship\Abstracts\Dto\Dto;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class UpdateProjectDto extends Dto
{
    public function __construct(
        public readonly string $uuid,
        public readonly string $userUuid,
        public readonly string $title,
        public readonly ?string $description = null,
    ) {
        //
    }
}
