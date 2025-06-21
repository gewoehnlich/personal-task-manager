<?php

namespace App\Services\API;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TokenService extends APIService
{
    public static function create(): string
    {
        $user        = self::getUserModel();
        $tokenExists = self::hasToken($user);
        if ($tokenExists) {
            self::deleteExistingTokens($user);
        }

        return self::createToken($user);
    }

    public static function renew(): string | null
    {
        $user        = self::getUserModel();
        $tokenExists = self::hasToken($user);
        if (!$tokenExists) {
            return null;
        }

        self::deleteExistingTokens($user);

        return self::createToken($user);
    }

    public static function delete(): bool
    {
        $user = self::getUserModel();
        self::deleteExistingTokens($user);

        return true;
    }

    private static function getUserModel(): User
    {
        $id   = Auth::id();
        $user = User::find($id);

        return $user;
    }

    private static function hasToken(
        User $user
    ): string | null {
        return !empty($user->tokens);
    }

    private static function createToken(
        User $user
    ): string {
        $token = $user->createToken(
            'personal-task-manager'
        )->plainTextToken;

        return $token;
    }

    private static function deleteExistingTokens(
        User $user
    ): void {
        $user->tokens()->delete();
    }
}
