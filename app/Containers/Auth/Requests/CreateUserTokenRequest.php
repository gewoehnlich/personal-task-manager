<?php

namespace App\Containers\Auth\Requests;

use App\Containers\Auth\Parents\Requests\UserTokenRequest;
use App\Containers\Auth\Transporters\CreateUserTokenTransporter;

final class CreateUserTokenRequest extends UserTokenRequest
{
    public function dataClass(): string
    {
        return CreateUserTokenTransporter::class;
    }

    public function authorize(): bool
    {
        return true;
    }
}
