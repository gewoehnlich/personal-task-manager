<?php

namespace App\Containers\Auth\Requests;

use App\Containers\Auth\Transporters\RevokeUserTokenTransporter;
use App\Ship\Parents\Requests\Request;

final class RevokeUserTokenRequest extends Request
{
    public function dataClass(): string
    {
        return RevokeUserTokenTransporter::class;
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
