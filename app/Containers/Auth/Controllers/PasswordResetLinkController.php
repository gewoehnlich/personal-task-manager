<?php

namespace App\Containers\Auth\Controllers;

use App\Ship\Abstracts\Controllers\WebController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

final readonly class PasswordResetLinkController extends WebController
{
    /**
     * Show the password reset link request page.
     *
     * @param Request $request
     */
    public function create(
        Request $request,
    ): Response {
        return Inertia::render('auth/ForgotPassword', [
            'status' => $request->session()->get('status'),
        ]);
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param Request $request
     *
     * @throws ValidationException
     */
    public function store(
        Request $request,
    ): RedirectResponse {
        $request->validate([
            'email' => 'required|email',
        ]);

        Password::sendResetLink(
            $request->only('email'),
        );

        return back()->with('status', __('A reset link will be sent if the account exists.'));
    }
}
