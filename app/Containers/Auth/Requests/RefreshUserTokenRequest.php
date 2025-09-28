<?php

namespace App\Containers\Auth\Requests;

use App\Containers\Auth\Transporters\RefreshUserTokenTransporter;
use App\Ship\Parents\Requests\Request;

final class RefreshUserTokenRequest extends Request
{
    public function dataClass(): string
    {
        return RefreshUserTokenTransporter::class;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //
        ];
    }
}
