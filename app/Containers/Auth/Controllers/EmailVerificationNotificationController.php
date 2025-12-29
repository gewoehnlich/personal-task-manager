<?php

namespace App\Containers\Auth\Controllers;

use App\Ship\Parents\Controllers\WebController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final readonly class EmailVerificationNotificationController extends WebController
{
    /**
     * Send a new email verification notification.
     *
     * @param Request $request
     */
    public function store(
        Request $request,
    ): RedirectResponse {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
