<?php

namespace App\Containers\Auth\Requests;

use App\Containers\Auth\Transporters\GetUserTokenTransporter;
use App\Ship\Parents\Requests\Request;

final class GetUserTokenRequest extends Request
{
    public function dataClass(): string
    {
        return GetUserTokenTransporter::class;
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
