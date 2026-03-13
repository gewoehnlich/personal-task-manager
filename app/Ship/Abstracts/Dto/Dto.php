<?php

namespace App\Ship\Abstracts\Dto;

use Illuminate\Contracts\Support\Arrayable;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
abstract readonly class Dto implements Arrayable
{
    //
}
