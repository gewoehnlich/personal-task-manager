<?php

namespace App\Containers\Auth\Parents\Requests;

use App\Containers\Auth\Parents\Transporters\UserTokenTransporter;
use App\Ship\Parents\Requests\Request;

class UserTokenRequest extends Request
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'user' => $this->user(),
        ]);
    }

    public function dataClass(): string
    {
        return UserTokenTransporter::class;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user' => ['required'],
        ];
    }
}
