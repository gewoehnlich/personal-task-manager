<?php

namespace App\Containers\Auth\Tasks;

use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tasks\Task;

final readonly class CheckIfUserTokenAlreadyExistsTask extends Task
{
    public function run(
        User $user,
    ): bool {
        return ! empty(
            $user->tokens()->get()->first()
        );
    }
}
