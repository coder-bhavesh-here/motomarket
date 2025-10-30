<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\TemporaryPasswordMail;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        // $status = Password::sendResetLink(
        //     $request->only('email')
        // );
        $user = User::where('email', $request->email)->first();
        $tempPassword = Str::random(8);
        if ($user) {
            $user->update([
                'password' => Hash::make($tempPassword),
            ]);
            Mail::to($user->email)->send(new TemporaryPasswordMail($user, $tempPassword));
        }
        $status = "Mail has been sent successfully.";
        return back()->with('status', __($status));
    }
}
