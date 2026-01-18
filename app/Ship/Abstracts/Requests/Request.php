<?php

namespace App\Ship\Abstracts\Requests;

use App\Ship\Contracts\Transportable;
use App\Ship\Exceptions\TransporterIsMissingException;
use App\Ship\Abstracts\Transporters\Transporter;
use Illuminate\Foundation\Http\FormRequest as LaravelRequest;

abstract class Request extends LaravelRequest implements Transportable
{
    abstract public function transporter(): string;

    public function transported(): Transporter
    {
        if (! $this->transporter()) {
            throw new TransporterIsMissingException();
        }

        return $this->transporter()::from(
            data: $this->validated()
        );
    }
}
