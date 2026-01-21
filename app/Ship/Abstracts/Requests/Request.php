<?php

namespace App\Ship\Abstracts\Requests;

use App\Ship\Abstracts\Dto\Dto;
use App\Ship\Contracts\Dtoable;
use App\Ship\Exceptions\DtoIsMissingException;
use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest implements Dtoable
{
    public function toDto(): Dto
    {
        if (! $this->dto()) {
            throw new DtoIsMissingException();
        }

        return $this->dto()::from(
            data: $this->validated(),
        );
    }

    abstract public function dto(): string;
}
