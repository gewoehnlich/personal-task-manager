<?php

namespace App\Ship\Contracts;

use App\Ship\Abstracts\Dto\Dto;

interface Dtoable
{
    public function dto(): string;

    public function toDto(): Dto;
}
