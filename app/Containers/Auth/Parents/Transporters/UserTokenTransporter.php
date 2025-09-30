<?php

namespace App\Containers\Auth\Parents\Transporters;

use App\Containers\Users\Models\User;
use App\Ship\Parents\Transporters\Transporter;

class UserTokenTransporter extends Transporter
{
    public function __construct(
        protected readonly User $user,
    ) {
        //
    }
}
