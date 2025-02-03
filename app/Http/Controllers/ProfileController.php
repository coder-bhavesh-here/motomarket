<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Tour;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    public function home(): View
    {
        $tours = Tour::with(['user', 'prices', 'images', 'favourites'])
            ->where('is_featured', operator: '1')->get();
        return view('home-landing', [
            'user' => Auth::user(),
            'tours' => $tours,
        ]);
    }
    public function newHome(): View
    {
        $tours = Tour::with(['user', 'prices', 'images', 'favourites'])
            ->where('is_featured', operator: '1')->get();
        return view('home', [
            'user' => Auth::user(),
            'tours' => $tours,
        ]);
    }

    public function exploreTours(Request $request): View|JsonResponse
    {
        $search = $request->get('search');
        $query = Tour::with(['user', 'prices', 'images', 'favourites']);

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhereHas('user', function ($query) use ($search) {
                    $query->where('tour_operation_name', 'like', '%' . $search . '%')
                        ->orWhere('name', 'like', '%' . $search . '%');
                });
        }

        $tours = $query->where('status', 'published')->paginate(4);

        if ($request->ajax()) {
            $viewData = [];
            foreach ($tours as $tour) {
                if ($tour->status === 'published') {
                    $viewData[] = [
                        'html' => view('partials.tour-card', compact('tour'))->render()
                    ];
                }
            }
            return response()->json(['tours' => $viewData]);
        }
        $countries = config('countries.list');
        return view('explore-tours', [
            'user' => Auth::user(),
            'tours' => $tours,
            'search' => $search,
            'countries' => $countries
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
        if ($request->has('cropped_image')) {
            $croppedImage = $request->input('cropped_image');
            $imageName = 'profile-' . $request->user()->id . '.png';
            $imagePath = storage_path('app/public/uploads/' . $imageName);

            list($type, $data) = explode(';', $croppedImage);
            list(, $data) = explode(',', $data);
            $decodedData = base64_decode($data);

            file_put_contents($imagePath, $decodedData);
            $request->user()->profile_picture = 'uploads/' . $imageName;
        }

        // if ($request->hasFile('profile_picture')) {
        //     $profilePicturePath = $request->file('profile_picture')->store('uploads', 'public');
        //     $request->user()->profile_picture = $profilePicturePath;
        // }

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
