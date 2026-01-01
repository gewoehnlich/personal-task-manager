<?php

namespace App\Containers\Auth\Controllers;

use App\Ship\Abstracts\Controllers\WebController;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

final readonly class VerifyEmailController extends WebController
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param EmailVerificationRequest $request
     */
    public function __invoke(
        EmailVerificationRequest $request,
    ): RedirectResponse {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            /** @var MustVerifyEmail $user */
            $user = $request->user();
            event(new Verified($user));
        }

        return redirect()->intended(
            default: route('dashboard', absolute: false) . '?verified=1',
        );
    }
}
