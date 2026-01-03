<?php

namespace App\Http\Controllers\Auth;

use App\Models\Otp; 
use App\Models\User; 
use App\Models\UserProfile; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SmsService; 
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Hash;
use App\Mail\AccountActivationCode; 
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class OtpController extends Controller
{
    public function send(Request $request, SmsService $sms)
    {
        $request->validate([
            'mobile' => 'required'
        ]);

        $normalized = $request->mobile;
        $mobileHash = hash('sha256', $normalized);

        $profile = UserProfile::where('mobile_hash', $mobileHash)->first();

        // 🔐 Prevent enumeration
        if (! $profile) {
            return back()->with([
                'data' => 'success',
                'message' => 'If this mobile is registered, an OTP has been sent.',
                'info' => 'n/a',
                'status' => 'success',
            ]);
        }

        // ⏱ Throttle OTP resend
        RateLimiter::attempt(
            'otp-send:' . $mobileHash,
            1, // max attempts
            fn () => true,
            60 // 60 seconds
        );

        $otp = rand(100000, 999999);

        Otp::updateOrCreate(
            ['mobile' => $mobileHash],
            [
                'code' => $otp,
                'expires_at' => now()->addMinutes(5)
            ]
        );

        $sms->sendSms($normalized, "Your login OTP is {$otp}");
        return back()->with([
            'data' => 'success',
            'message' => 'If this mobile is registered, an OTP has been sent.',
            'info' => $otp,
            'status' => 'success',
        ]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'mobile' => 'required',
            'code' => 'required|digits:6'
        ]);
        $mobileHash = hash('sha256', $request->mobile);
        $otp = Otp::where('mobile', $mobileHash)
                  ->where('code', $request->code)
                  ->first();

        if (!$otp || $otp->expires_at->isPast()) {
            return back()->withErrors(['code' => 'Invalid or expired code.']);
        }
        $user = User::whereHas('profile', function ($q) use ($mobileHash) {
            $q->where('mobile_hash', $mobileHash);
        })->first();

        if($user->is_active) {
            if($user->must_change) {
                do{
                    $code = random_int(100000000, 999999999); // 9 digits
                } while (\App\Models\User::where('code', $code)->exists());

                $user->update(['code' => $code]);

                
                Mail::to($user->email)->queue(new AccountActivationCode($user, $code));
                 \Auth::login($user);
            $otp->delete();
                return redirect()->intended(route('activation', absolute: false));
            }
            
            \Auth::login($user);
            $otp->delete();
            return redirect()->intended(route('dashboard', absolute: false));
        }else{
            throw ValidationException::withMessages([
                'email' => 'Account Locked, Please contact administrator.',
            ]);
        }

        // \Auth::login($user);
        // $otp->delete();

        // return redirect()->route('dashboard');
    }
}
