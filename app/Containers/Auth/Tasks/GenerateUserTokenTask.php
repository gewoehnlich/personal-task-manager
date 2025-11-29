<?php

namespace App\Containers\Auth\Tasks;

use App\Containers\Users\Models\User;
use App\Ship\Parents\Tasks\Task;

final readonly class GenerateUserTokenTask extends Task
{
    public function run(
        User $user,
    ): string {
        return $user->createToken('gewoehnlich')->plainTextToken;
    }
}
