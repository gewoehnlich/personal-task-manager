<?php

namespace App\Containers\Auth\Transporters;

use App\Containers\Auth\Parents\Transporters\UserTokenTransporter;
use App\Containers\Users\Models\User;

final class CreateUserTokenTransporter extends UserTokenTransporter
{
    public function __construct(
        public readonly User $user,
    ) {
        //
    }
}
