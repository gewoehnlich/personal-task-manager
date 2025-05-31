<?php

namespace App\Services\API\Tokens;

use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TokenService // extends Service
{
    public static function create(): string
    {
        $user = self::getUserModel();
        /*$existingToken = self::getExistingToken(*/
        /*    $user*/
        /*);*/
        /**/
        /*if ($existingToken) {*/
        /*    return $existingToken;*/
        /*}*/

        $token = $user->createToken(
            'personal-task-manager'
        )->plainTextToken;

        return $token;
    }

    public static function read(): string | null
    {
        $user = self::getUserModel();
        $existingToken = self::getExistingToken(
            $user
        );

        if (!$existingToken) {
            return null;
        }

        return $existingToken;
    }

    public static function update(): string | null
    {
        $user = self::getUserModel();
        $existingToken = self::getExistingToken(
            $user
        );

        if (!$existingToken) {
            return null;
        }

        $token = $user->tokens()->update([

        ]);
    }

    public static function delete(): string
    {
        $user = self::getUserModel();
        $existingToken = self::getExistingToken(
            $user
        );
    }

    private static function getUserModel(): User
    {
        $user = User::find(
            Auth::id()
        );

        return $user;
    }

    private static function getExistingToken(
        User $user
    ): string | null {
        /*return $user->plai*/
    }
}
