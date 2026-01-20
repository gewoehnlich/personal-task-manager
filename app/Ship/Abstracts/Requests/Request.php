<?php

namespace App\Ship\Abstracts\Requests;

use App\Ship\Abstracts\Dto\Dto;
use App\Ship\Contracts\Dtoable;
use App\Ship\Exceptions\TransporterIsMissingException;
use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest implements Dtoable
{
    abstract public function dto(): string;

    public function toDto(): Dto
    {
        if (! $this->dto()) {
            throw new TransporterIsMissingException();
        }

        return $this->dto()::from(
            data: $this->validated(),
        );
    }
}
