<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function home(): View
    {
        $tours = Tour::with(['user', 'prices', 'images', 'favourites'])
            ->where('is_featured', operator: '1')->get();
        return view('home', [
            'user' => Auth::user(),
            'tours' => $tours,
        ]);
    }
    public function newHome(): View
    {
        $tours = Tour::with(['user', 'prices', 'images', 'favourites'])
            ->where('is_featured', operator: '1')
            ->inRandomOrder()
            ->take(8)
            ->get();
        return view('home', [
            'user' => Auth::user(),
            'tours' => $tours,
        ]);
    }

    public function exploreTours(Request $request, $nickName = null): View|JsonResponse
    {
        // dd($request->all());
        $search = $request->get('search');
        $query = Tour::with(['user', 'prices', 'images', 'favourites']);

        if ($nickName && $nickName != null) {
            $query->whereHas('user', function ($query) use ($search) {
                $query->where('tour_nickname', $nickName);
            });
        }
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhereHas('user', function ($query) use ($search) {
                    $query->where('tour_operation_name', 'like', '%' . $search . '%')
                        ->orWhere('name', 'like', '%' . $search . '%');
                })
                ->orWhereRaw("FIND_IN_SET(?, countries)", [$search]);
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
            if (empty($filters['currency'])) {
                $filters['currency'] = 'EUR';
            }
        }
        if (!empty($filters['start'])) {
            $query->whereHas('prices', function ($q) use ($filters) {
                $q->where('date', '>=', $filters['start']);
            });
        }

        // Filter by tour type (road, enduro, etc.)
        if (!empty($filters['tour_type'])) {
            $query->whereIn('riding_style', $filters['tour_type']);
        }

        // Filter by tour level (Beginner, Intermediate, etc.)
        if (!empty($filters['tour_level'])) {
            $query->where(function ($q) use ($filters) {
                foreach ($filters['tour_level'] as $capability) {
                    $q->orWhereRaw("FIND_IN_SET(?, rider_capability)", [$capability]);
                }
            });
        }


        // Filter by bike options (own bike, rental, etc.)
        if (!empty($filters['bike_options'])) {
            if (count($filters['bike_options']) > 1) {
                $query->whereIn('bike_option', [Tour::BRING_OWN_BIKE, Tour::BIKE_RENTAL, Tour::BIKE_INCLUDED]);
            } else {
                if (in_array('own_bike', $filters['bike_options'])) {
                    $query->whereIn('bike_option', [Tour::BRING_OWN_BIKE]);
                }
                if (in_array('rental_included', $filters['bike_options'])) {
                    $query->whereIn('bike_option', [Tour::BIKE_RENTAL, Tour::BIKE_INCLUDED]);
                }
            }
        }
        if (!empty($filters['riding_gear'])) {
            $query->whereIn('rent_gear', $filters['riding_gear']);
        }

        // Filter by two-riding option (yes/no)
        if (!empty($filters['two_riding'])) {
            $query->where('two_up_riding', ($filters['two_riding'][0] === 'yes' ? 1 : 0)); // Assuming it's a single-value array
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
            'filters' => $filters,
            'countries' => $countries
        ]);
    }

    public function tourManagement(Request $request): View|JsonResponse
    {
        // dd($request->all());
        $search = $request->get('search');
        $query = Tour::with(['user', 'prices', 'images', 'favourites'])->where('permanently_deleted', false)->where('user_id', Auth::user()->id);

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhereHas('user', function ($query) use ($search) {
                    $query->where('tour_operation_name', 'like', '%' . $search . '%')
                        ->orWhere('name', 'like', '%' . $search . '%');
                });
        }

        $tours = $query->where('status', 'published')->get();
        $countries = config('countries.list');
        return view('tour-management', [
            'user' => Auth::user(),
            'tours' => $tours,
            'search' => $search,
            'countries' => $countries
        ]);
    }
    public function draftTourManagement(Request $request): View|JsonResponse
    {
        $search = $request->get('search');
        $query = Tour::with(['user', 'prices', 'images', 'favourites'])->where('permanently_deleted', false)->where('user_id', Auth::user()->id);

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhereHas('user', function ($query) use ($search) {
                    $query->where('tour_operation_name', 'like', '%' . $search . '%')
                        ->orWhere('name', 'like', '%' . $search . '%');
                });
        }

        $tours = $query->where('status', 'draft')->get();
        $countries = config('countries.list');
        return view('drafts-tour-management', [
            'user' => Auth::user(),
            'tours' => $tours,
            'search' => $search,
            'countries' => $countries
        ]);
    }
    public function hiddenTourManagement(Request $request): View|JsonResponse
    {
        $search = $request->get('search');
        $query = Tour::with(['user', 'prices', 'images', 'favourites'])->where('permanently_deleted', false)->where('user_id', Auth::user()->id);

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhereHas('user', function ($query) use ($search) {
                    $query->where('tour_operation_name', 'like', '%' . $search . '%')
                        ->orWhere('name', 'like', '%' . $search . '%');
                });
        }

        $tours = $query->where('status', 'draft')->get();
        $countries = config('countries.list');
        return view('hidden-tour-management', [
            'user' => Auth::user(),
            'tours' => $tours,
            'search' => $search,
            'countries' => $countries
        ]);
    }
    public function deletedTourManagement(Request $request): View|JsonResponse
    {
        $search = $request->get('search');
        $query = Tour::with(['user', 'prices', 'images', 'favourites'])->where('permanently_deleted', false)->where('user_id', Auth::user()->id);

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhereHas('user', function ($query) use ($search) {
                    $query->where('tour_operation_name', 'like', '%' . $search . '%')
                        ->orWhere('name', 'like', '%' . $search . '%');
                });
        }

        $tours = $query->onlyTrashed()->get();
        $countries = config('countries.list');
        return view('deleted-tour-management', [
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
     * Display the user's profile form.
     */
    public function editTourProfile(Request $request): View
    {
        return view('tour-profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function updated(Request $request): RedirectResponse
    {
        // $request->user()->fill($request->validated());
        $user = $request->user();

        // Map request fields to DB columns explicitly
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->nickname = $request->input('nickname');
        $user->nationality = $request->input('nationality');
        $user->address = $request->input('address');
        $user->country = $request->input('country');
        $user->pincode = $request->input('pincode');
        $user->dob = $request->input('dob');
        $user->contact_number = $request->input('contact_number');
        $user->introduction = $request->input('introduction');

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $existingImages = $user->riding_images ?? [];
        $newImages = [];
        for ($i = 0; $i < 5; $i++) {
            if ($request->hasFile("riding_images.$i")) {
                $newImages[$i] = $request->file("riding_images.$i")->store('riding_images', 'public');
            } else {
                $newImages[$i] = $existingImages[$i] ?? null;
            }
        }
        // Re-index array to avoid saving with gaps like [0 => 'img', 2 => 'img2']
        $user->riding_images = array_values(array_filter($newImages));
        $user->save();

        $request->user()->save();

        return Redirect::route('profile.edit');
    }
    public function tourProfileUpdated(Request $request): RedirectResponse
    {
        // $request->user()->fill($request->validated());
        $user = $request->user();

        // Map request fields to DB columns explicitly
        $user->tour_operation_name = $request->input('name');
        // $user->tour_last_name = $request->input('last_name');
        $user->tour_nickname = $request->input('nickname');
        $user->tour_dob = $request->input('dob');
        $user->tour_currency = $request->input('tour_currency');
        $user->tour_contact_number = $request->input('contact_number');
        $user->tour_contact_email = $request->input('email');
        $user->tour_introduction = $request->input('introduction');
        $user->company_showcase_link1 = $request->input('company_showcase_link1');
        $user->company_showcase_link2 = $request->input('company_showcase_link2');
        $existingImages = $user->tour_riding_images ?? [];
        $newImages = [];
        for ($i = 0; $i < 10; $i++) {
            if ($request->hasFile("riding_images.$i")) {
                $newImages[$i] = $request->file("riding_images.$i")->store('riding_images', 'public');
            } else {
                $newImages[$i] = $existingImages[$i] ?? null;
            }
        }
        $user->tour_riding_images = array_values(array_filter($newImages));
        $user->save();
        $request->user()->save();
        return Redirect::route('tour-profile.edit');
    }

    public function paymentEdit()
    {
        $user = auth()->user();
        return view('payment.edit', compact('user'));
    }

    public function paymentUpdate(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'tour_currency' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'bank_operating_country' => 'nullable|string',
            'iban' => 'nullable|string',
            'swift_bic' => 'nullable|string',
            'bank_account_number' => 'nullable|string',
            'sort_code' => 'nullable|string',
            'account_name' => 'nullable|string',
        ]);

        $user->update($validated);
        return redirect()->back()->with('success', 'Payment settings updated successfully.');
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

    public function verifyEmail()
    {
        return view('auth.verify');
    }

    public function profiles()
    {
        return view('profile', [
            'user' => auth()->user(),
        ]);
    }
    public function updateTourProfileStatus(Request $request)
    {
        $user = auth()->user();
        $disableProfile = $request->input('tour_profile') == false; // user wants to disable

        if ($disableProfile) {
            // Check if user has tours
            $upcomingTours = Tour::where('user_id', $user->id)
                ->where('status', 'published') // only published tours
                ->where('permanently_deleted', false) // not permanently deleted
                ->whereNull('deleted_at') // not soft deleted
                ->whereHas('prices', function ($query) {
                    $query->whereDate('date', '>=', now()); // any future date
                })
                ->exists();

            if ($upcomingTours) {
                return response()->json([
                    'message' => 'You cannot disable your tour profile while you have upcoming tours.'
                ]);
            }
        }
        $user->tour_profile_enabled = $request->input('tour_profile');
        $user->is_tour_policy_checked = $request->input('terms');
        $user->save();
        return response()->json(['message' => 'Tour profile status updated successfully.']);
    }
    function showUser($nickname)
    {
        $user = User::whereRaw('LOWER(nickname) = ?', [strtolower($nickname)])->first();
        return view('users.show', compact('user'));
    }
    function showTourUser($nickname)
    {
        $user = user::whereRaw('LOWER(tour_nickname) = ?', [strtolower($nickname)])->first();
        if ($user) {
            $tours = Tour::with(['user', 'prices', 'images', 'favourites'])
                ->where('user_id', $user->id)->get();
        }
        return view('tour_operators.show', compact('user', 'tours'));
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'cropped_image' => 'required|string'
        ]);

        $user = auth()->user();
        $image = $request->input('cropped_image');
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));

        $filename = 'uploads/profile_' . time() . '.png';
        Storage::disk('public')->put($filename, $imageData);

        $user->profile_picture = $filename;
        $user->save();

        return response()->json(['status' => 'success']);
    }

    public function updateTourPicture(Request $request)
    {
        $request->validate([
            'cropped_image' => 'required|string'
        ]);

        $user = auth()->user();
        $image = $request->input('cropped_image');
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));

        $filename = 'uploads/tour_' . time() . '.png';
        Storage::disk('public')->put($filename, $imageData);

        $user->tour_profile_picture = $filename;
        $user->save();

        return response()->json(['status' => 'success']);
    }
}
