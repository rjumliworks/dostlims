<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialAuthController extends Controller
{
    public function redirect(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors('Unable to login.');
        }

        $user = User::where('provider', $provider)
            ->where('provider_id', $socialUser->getId())
            ->first();

        if (!$user) {
            $email = strtolower($socialUser->getEmail());
            $kradworkz = hash('sha256', $email);
            $user = User::where('kradworkz', $kradworkz)->first();

            if ($user) {
                // Link existing account
                $user->update([
                    'provider'    => $provider,
                    'provider_id' => $socialUser->getId(),
                    // 'avatar'      => $socialUser->getAvatar(),
                ]);
            } else {
                // Create new user
                $user = User::create([
                    'provider'    => $provider,
                    'provider_id' => $socialUser->getId(),
                    'email_verified_at' => now()
                ]);
            }
        }

        Auth::login($user, true);

        return redirect()->intended('/dashboard');
    }

    private function splitFirstLast(string $fullName): array
    {
        $parts = preg_split('/\s+/', trim($fullName));

        $firstName = $parts[0] ?? null;
        $lastName  = count($parts) > 1 ? end($parts) : null;

        return [
            'first_name' => $firstName,
            'last_name'  => $lastName,
        ];
    }
}
