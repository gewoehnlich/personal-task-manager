<?php

namespace App\Containers\Auth\Tasks;

use App\Containers\Users\Models\User;
use App\Ship\Parents\Tasks\Task;

final readonly class DeleteExistingTokensTask extends Task
{
    public function run(
        User $user,
    ): bool {
        return $user->tokens()->delete();
    }
}
