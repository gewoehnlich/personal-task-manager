<?php

namespace App\Containers\Auth\Requests;

use App\Ship\Parents\Requests\Request;

final class CreateUserTokenRequest extends Request
{
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
