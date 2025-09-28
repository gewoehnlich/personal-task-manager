<?php

namespace App\Containers\Auth\Requests;

use App\Containers\Auth\Transporters\CreateUserTokenTransporter;
use App\Ship\Parents\Requests\Request;

final class CreateUserTokenRequest extends Request
{
    public function dataClass(): string
    {
        return CreateUserTokenTransporter::class;
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
