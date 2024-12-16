<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Tour;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function home(): View
    {
        $tours = Tour::with(['user', 'prices', 'images', 'favourites'])
            ->where('is_featured', '1')->limit(6)->get();
        return view('home', [
            'user' => Auth::user(),
            'tours' => $tours,
        ]);
    }

    public function exploreTours(): View
    {
        $tours = Tour::with(['user', 'prices', 'images', 'favourites'])->where('status', 'published')->get();
        return view('explore-tours', [
            'user' => Auth::user(),
            'tours' => $tours,
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function dashboard(): View
    {
        return view('dashboard', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('uploads', 'public');
            $request->user()->profile_picture = $profilePicturePath;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
