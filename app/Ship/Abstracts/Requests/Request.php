<?php

namespace App\Ship\Abstracts\Requests;

use Illuminate\Foundation\Http\FormRequest as LaravelRequest;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\WithData;
use App\Ship\Exceptions\TransporterIsMissingException;

abstract class Request extends LaravelRequest
{
    use WithData;

    abstract public function dataClass(): string;

    public function transported(): Data
    {
        if (! $this->dataClass()) {
            throw new TransporterIsMissingException();
        }

        return $this->dataClass()::from($this->validated());
    }
}
