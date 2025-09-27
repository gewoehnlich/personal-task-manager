<?php

namespace App\Containers\Auth\Controllers;

use App\Ship\Parents\Controllers\WebController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EmailVerificationPromptController extends WebController
{
    /**
     * Show the email verification prompt page.
     */
    public function __invoke(
        Request $request
    ): RedirectResponse | Response {
        return $request->user()->hasVerifiedEmail()
            ? redirect()->intended(
                default: route('dashboard', absolute: false)
            )
            : Inertia::render('auth/VerifyEmail', [
                'status' => $request->session()->get('status')
            ]);
    }
}
