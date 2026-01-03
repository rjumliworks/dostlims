<?php

namespace App\Http\Controllers\Auth;

use App\Mail\AccountActivationCode; 
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function create(): Response|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->intended(route('dashboard'));
        }

        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        $request->session()->put('two_factor_authenticated', false);

        $user = Auth::user();
        
        if($user->is_active) {
            if($user->must_change) {
                do{
                    $code = random_int(100000000, 999999999); // 9 digits
                } while (\App\Models\User::where('code', $code)->exists());

                $user->update(['code' => $code]);

                
                Mail::to($user->email)->queue(new AccountActivationCode($user, $code));
               
                return redirect()->intended(route('activation', absolute: false));
            }
            return redirect()->intended(route('dashboard', absolute: false));
        }else{
            throw ValidationException::withMessages([
                'email' => 'Account Locked, Please contact administrator.',
            ]);
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        // Prevent session fixation attacks
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

}
