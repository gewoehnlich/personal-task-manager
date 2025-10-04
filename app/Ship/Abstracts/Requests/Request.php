<?php

namespace App\Ship\Abstracts\Requests;

use App\Ship\Contracts\Transportable;
use Illuminate\Foundation\Http\FormRequest as LaravelRequest;
use Spatie\LaravelData\WithData;
use App\Ship\Exceptions\TransporterIsMissingException;
use App\Ship\Parents\Transporters\Transporter;

abstract class Request extends LaravelRequest implements Transportable
{
    use WithData;

    abstract public function transporter(): string;

    public function transported(): Transporter
    {
        if (! $this->transporter()) {
            throw new TransporterIsMissingException();
        }

        return $this->transporter()::from($this->validated());
    }
}
