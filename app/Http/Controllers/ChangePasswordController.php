<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\ConfirmPasswordChangeMail;
use Illuminate\Support\Facades\Cache;

class ChangePasswordController extends Controller
{
    public function requestChange(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        $user = Auth::user();

        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Incorrect current password.']);
        }

        // Generate secure token and store temporarily (5–10 min)
        $token = Str::random(64);
        Cache::put('password_change_' . $token, [
            'user_id' => $user->id,
            'new_password' => Hash::make($request->new_password),
        ], now()->addMinutes(10));

        // Send confirmation mail
        Mail::to($user->email)->send(new ConfirmPasswordChangeMail($user, $token));

        return back()->with('status', 'We’ve sent a confirmation link to your email.');
    }

    public function confirmChange($token)
    {
        $data = Cache::get('password_change_' . $token);

        if (!$data) {
            return redirect()->route('login')->withErrors(['token' => 'Link expired or invalid.']);
        }

        $user = User::find($data['user_id']);
        dd($user);
        if ($user) {
            $user->update(['password' => $data['new_password']]);
        }

        Cache::forget('password_change_' . $token);

        return redirect()->route('login')->with('status', 'Your password has been changed successfully.');
    }
}
