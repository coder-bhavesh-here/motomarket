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
        // dd($request->all());
        $search = $request->get('search');
        $query = Tour::with(['user', 'prices', 'images', 'favourites']);

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhereHas('user', function ($query) use ($search) {
                    $query->where('tour_operation_name', 'like', '%' . $search . '%')
                        ->orWhere('name', 'like', '%' . $search . '%');
                });
        }

        $filters = $request->all();

        // Filter by selected countries (handling comma-separated values)
        if (!empty($filters['countries'])) {
            $query->where(function ($q) use ($filters) {
                foreach ($filters['countries'] as $country) {
                    $q->orWhereRaw("FIND_IN_SET(?, countries)", [$country]);
                }
            });
        }

        // Filter by minimum days
        if (!empty($filters['min_days'])) {
            $query->where('duration_days', '>=', $filters['min_days']);
        }

        // Filter by max price (assuming 'max_price' is a numeric value)
        if (!empty($filters['max_price']) && is_numeric($filters['max_price'])) {
            $query->whereHas('prices', function ($q) use ($filters) {
                $q->where('price', '<=', $filters['max_price']);
            });
        }

        // Filter by tour type (road, enduro, etc.)
        if (!empty($filters['tour_type'])) {
            $query->whereIn('riding_style', $filters['tour_type']);
        }

        // Filter by tour level (Beginner, Intermediate, etc.)
        if (!empty($filters['tour_level'])) {
            $query->whereIn('rider_capability', $filters['tour_level']);
        }

        // Filter by bike options (own bike, rental, etc.)
        if (!empty($filters['bike_options'])) {
            if ($filters['bike_options'] === 'own_bike') {
                $query->whereIn('bike_option', Tour::BRING_OWN_BIKE);
            } else {
                $query->whereIn('bike_option', [Tour::BIKE_RENTAL, Tour::BIKE_INCLUDED]);
            }
        }
        if (!empty($filters['riding_gear'])) {
            $query->whereIn('rent_gear', $filters['riding_gear']);
        }

        // Filter by two-riding option (yes/no)
        if (!empty($filters['two_riding'])) {
            $query->where('two_up_riding', $filters['two_riding'][0]); // Assuming it's a single-value array
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
