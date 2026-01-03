<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

use Inertia\Inertia;
use Inertia\Response;
use App\Http\Requests\ForgotRequest;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(ForgotRequest $request): RedirectResponse
    {
        $request->ensureIsNotRateLimited();

        // Ensure user exists, is active, and verified
        $user = $request->validatedUser();

        $status = Password::sendResetLink([
            'email' => $user->email,
        ]);

        RateLimiter::hit($request->throttleKey());

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
