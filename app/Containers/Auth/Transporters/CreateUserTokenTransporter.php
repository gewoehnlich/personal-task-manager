<?php

namespace App\Containers\Auth\Transporters;

use App\Containers\Users\Models\User;
use App\Ship\Parents\Transporters\Transporter;

final class CreateUserTokenTransporter extends Transporter
{
    public function __construct(
        public readonly User $user,
    ) {
        //
    }
}
