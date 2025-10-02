<?php

namespace App\Containers\Auth\Transporters;

use App\Containers\Users\Models\User;
use App\Ship\Parents\Transporters\Transporter;

final class RefreshUserTokenTransporter extends Transporter
{
    public function __construct(
        public readonly User $user,
    ) {
        //
    }
}
