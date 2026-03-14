<?php

namespace App\Ship\Abstracts\Requests;

use App\Ship\Abstracts\Dto\Dto;
use App\Ship\Contracts\Dtoable;
use App\Ship\Exceptions\DtoIsMissingException;
use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest implements Dtoable
{
    abstract public function dto(): string;

    abstract protected function extract(): array;

    public function toDto(): Dto
    {
        if (! $this->dto()) {
            throw new DtoIsMissingException();
        }

        return $this->dto()::from(
            inputData: $this->extract(),
        );
    }

    public function authorize(): bool
    {
        return true;
    }
}
