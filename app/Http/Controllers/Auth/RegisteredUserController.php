<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->string('password')),
        ]);

        $now = now();
        if (!$user->verification_code_sent_at || $now->diffInMinutes($user->verification_code_sent_at) >= 10) {
            $verificationCode = rand(100000, 999999);
            $user->verification_code = $verificationCode;
            $user->verification_code_sent_at = $now;
            $user->save();

            Mail::to($user->email)->send(new VerifyEmail($verificationCode));
            event(new Registered($user));
        }
        return view(
            'auth.verify',
            ["email" => $user->email]
        );
    }

    public function updateOtp($email)
    {
        $email = base64_decode($email);
        $user = User::where('email', $email)->first();
        $now = now();
        if ($user->verification_code_sent_at && $now->diffInMinutes($user->verification_code_sent_at) < 10) {
            return view('auth.verify', [
                "email" => $user->email
            ])->with('info', 'An OTP was already sent recently. Please check your email.');
        }
        $verificationCode = rand(100000, 999999);
        $user->verification_code = $verificationCode;
        $user->verification_code_sent_at = $now;
        $user->save();
        Mail::to($user->email)->send(new VerifyEmail($verificationCode));
        event(new Registered($user));
        return view(
            'auth.verify',
            ["email" => $user->email]
        );
    }

    public function forceResendOtp($email)
    {
        $email = base64_decode($email);
        $user = User::where('email', $email)->firstOrFail();
        $verificationCode = rand(100000, 999999);
        $user->verification_code = $verificationCode;
        $user->verification_code_sent_at = now();
        $user->save();
        Mail::to($user->email)->send(new VerifyEmail($verificationCode));
        event(new Registered($user));
        return view('auth.verify', [
            "email" => $user->email
        ])->with('success', 'A new OTP has been sent to your email.');
    }
    public function forceResendOtpAjax(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        $verificationCode = rand(100000, 999999);
        $user->verification_code = $verificationCode;
        $user->verification_code_sent_at = now();
        $user->save();

        Mail::to($user->email)->send(new VerifyEmail($verificationCode));
        event(new Registered($user));

        return response()->json([
            'success' => 'A new OTP has been sent to your email.'
        ]);
    }


    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $user = User::where('email', $request->email)
            ->where('verification_code', $request->otp)
            ->first();

        if (!$user) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        $user->is_verified = true;
        $user->verification_code = null;
        $user->save();

        Auth::login($user);
        return redirect()->route('dashboard')->with('success', 'Email verified successfully!');
    }
}
