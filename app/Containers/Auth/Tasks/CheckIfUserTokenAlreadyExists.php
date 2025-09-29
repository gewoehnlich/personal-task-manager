<?php

namespace App\Containers\Auth\Tasks;

use App\Containers\Users\Models\User;
use App\Ship\Parents\Tasks\Task;

final readonly class CheckIfUserTokenAlreadyExistsTask extends Task
{
    public function run(
        User $user,
    ): bool {
        dd($user);
        dd($user->tokens());
        return !empty($user->tokens());
    }
}
