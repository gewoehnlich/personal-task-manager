<?php

namespace App\Containers\Auth\Controllers;

use App\Containers\Auth\Requests\LoginRequest;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

final readonly class AuthenticatedSessionController extends WebController
{
    /**
     * Show the login page.
     */
    public function create(
        Request $request
    ): Response {
        return Inertia::render('auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status'           => $request->session()->get('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(
        LoginRequest $request
    ): RedirectResponse {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(
            default: route('dashboard', absolute: false)
        );
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(
        Request $request
    ): RedirectResponse {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
