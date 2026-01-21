<?php

namespace App\Containers\Tasks\Dto;

use App\Ship\Abstracts\Dto\Dto;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class DeleteTaskDto extends Dto
{
    public function __construct(
        public readonly string $uuid,
        public readonly string $userUuid,
    ) {
        //
    }
}
