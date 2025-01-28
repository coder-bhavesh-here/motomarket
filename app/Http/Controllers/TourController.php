<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmed;
use App\Mail\BookingConfirmedAgency;
use App\Models\Booking;
use App\Models\FavouriteTour;
use App\Models\Tour;
use App\Models\TourAddOn;
use App\Models\TourImage;
use App\Models\TourPrice;
use App\Models\TourQuestion;
use App\Models\TourSetting;
use App\Models\User;
use Carbon\Carbon;
use Hamcrest\Type\IsNumeric;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Stripe\StripeClient;

class TourController extends Controller
{
    public function index(): View
    {
        $userId = auth()->user()->id;
        $tours = Tour::where('user_id', $userId)->get();
        $tourIds = Tour::where('user_id', $userId)->pluck('id')->toArray();
        $bookingsCount = Booking::select('tour_id', DB::raw('COUNT(*) as booking_count'))
            ->whereIn('tour_id', $tourIds)
            ->groupBy('tour_id')
            ->pluck('booking_count', 'tour_id')
            ->toArray();
        $savedCount = FavouriteTour::select('tour_id', DB::raw('COUNT(*) as saved_count'))
            ->whereIn('tour_id', $tourIds)
            ->groupBy('tour_id')
            ->pluck('saved_count', 'tour_id')
            ->toArray();
        $today = Carbon::today()->toDateString(); // Get today's date in 'Y-m-d' format
        $upcomingTours = DB::table('tour_prices')
            ->select('tour_id', DB::raw('MIN(date) as next_tour_date')) // Get the earliest (MIN) date
            ->whereIn('tour_id', $tourIds) // Filter only the passed tour IDs
            ->where('date', '>=', $today) // Date should be today or in the future
            ->groupBy('tour_id') // Group results by tour_id
            ->pluck('next_tour_date', 'tour_id') // Return associative array: tour_id => next_tour_date
            ->toArray();
        return view('tours-list', [
            'tours' => $tours,
            'bookingsCount' => $bookingsCount,
            'savedCount' => $savedCount,
            'upcomingTours' => $upcomingTours,
        ]);
    }

    public function bookings()
    {
        $userId = auth()->user()->id;
        $tourIds = Tour::where('user_id', $userId)->where('status', 'published')->pluck('id');
        $bookings = Booking::select([
            'tours.id',
            'tours.title',
            'bookings.name',
            'bookings.dob',
            'bookings.nationality',
            'bookings.mobile_number',
            'bookings.date',
            'bookings.amount',
            'tours.tour_distance',
            'bookings.created_at',
        ])->whereIn('bookings.tour_id', $tourIds)->leftJoin('tours', 'bookings.tour_id', 'tours.id')->get();
        return view('bookings', [
            'bookings' => $bookings
        ]);
    }

    public function myTours(): View
    {
        $userId = auth()->user()->id;
        $tours = Booking::select([
            'tours.id',
            'tours.title',
            'tours.rider_capability',
            'tours.duration_days',
            'tours.max_riders',
            'tours.guides',
            'bookings.date',
            'bookings.amount',
            'tours.tour_distance',
            'bookings.created_at',
        ])->where('bookings.user_id', $userId)->leftJoin('tours', 'bookings.tour_id', 'tours.id')->get();
        return view('my-tours-list', [
            'tours' => $tours
        ]);
    }

    public function myFavouriteTours(): View
    {
        $favouriteTours = auth()->user()->favouriteTours->pluck('tour_id')->toArray();
        $tours = Tour::whereIn('id', $favouriteTours)->get();
        return view('favourite-tours-list', [
            'tours' => $tours
        ]);
    }

    function create(): View
    {
        return view('livewire.tours.tour-wizard', [
            'tours' => auth()->user()->tours()->get()
        ]);
    }

    public function show($tourId): View
    {
        $tour = Tour::find($tourId);
        $tourQuestions = TourQuestion::where('tour_id', $tourId)->get();
        $tour->tourQuestions = $tourQuestions;
        return view('tour-detail', [
            'tour' => $tour,
        ]);
    }

    public function makePayment(Request $request)
    {
        //  validate the request
        $request->validate([
            'id' => 'required|numeric',
            'price' => 'required'
        ]);
        $tourPriceDetails = TourPrice::find($request->id);
        $tour = Tour::find($tourPriceDetails->tour_id);
        $image = TourImage::where('tour_id', $tour->id)->first();
        if ($image != null) {
            $imagePath = asset('storage') . '/' . $image->image_path;
        } else {
            $imagePath = asset('images/bike4.jpg');
        }
        // stripe integration to generate the payment link
        // create a stripe product
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        $product = $stripe->products->create([
            'name' => 'Tour Payment',
            'description' => 'Payment for : ' . $tour->title,
            'images' => [$imagePath],
        ]);
        // create a stripe price
        $price = $stripe->prices->create([
            'product' => $product->id,
            'unit_amount' => 2000,
            'currency' => 'usd',
        ]);
        // create a payment link
        $paymentLink = $stripe->paymentLinks->create([
            'line_items' => [[
                'price' => $price->id,
                'quantity' => 1,
            ]],
        ]);
        // redirect to the payment link
        return redirect($paymentLink->url);
        // return json_encode(['redirect_url' => $paymentLink->url]);
    }

    public function book($priceId): View
    {
        $price = TourPrice::find($priceId);
        $tour = Tour::with(['prices', 'addons'])->find($price->tour_id);
        return view('book', [
            'tour' => $tour,
            'nationalities' => ['India', 'Europe', 'US  '],
            'tourDates' => $tour->prices,
            'selectedDate' => $price
        ]);
    }

    public function publishTour(Request $request)
    {
        $tourId = $request->tour_id;
        Tour::where('id', $tourId)->update(array(
            'status' => 'published',
        ));
        return response()->json(['success' => 'Tour published successfully.'], 200);
    }

    public function deleteImage(Request $request)
    {
        $tourImageId = $request->tourImageId;
        $imageDetails = TourImage::find($tourImageId);
        unlink(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) . '/public/storage/' . $imageDetails->image_path);
        $imageDetails->delete();
        return response()->json(['success' => 'Image deleted successfully.'], 200);
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        $tour_id = $request->tour_id;
        if ($request->file()) {
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            $image = TourImage::create([
                'image_path' => $filePath,
                'tour_id' => $tour_id,
            ]);
            $image->save();
            return response()->json(['success' => 'File uploaded successfully', 'file' => $fileName, 'image_id' => $image->id]);
        }
        return response()->json(['error' => 'File upload failed'], 500);
    }

    public function saveFirstStep(Request $request)
    {
        $postData = $request->firstStepData;
        $userId = auth()->user()->id;
        if (isset($postData['tour_id']) && $postData['tour_id'] != null && is_numeric($postData['tour_id'])) {
            $tour = Tour::find($postData['tour_id']);
            $tour->title = $postData['title'];
            $tour->riding_style = $postData['riding_style'];
            $tour->support = $postData['support'];
            $tour->riding_style_info = $postData['riding_style_info'];
            $tour->rider_capability = $postData['rider_capability'];
            $tour->rider_capability_info = $postData['rider_capability_info'];
            $tour->duration_days = $postData['duration_days'];
            $tour->rest_days = $postData['rest_days'];
            $tour->max_riders = $postData['max_riders'];
            $tour->guides = $postData['guides'];
            $tour->bike_option = $postData['bike_option'];
            $tour->rent_gear = $postData['rent_gear'];
            $tour->two_up_riding = $postData['two_up_riding'];
            $tour->bike_specification = $postData['bike_specification'];
            $tour->tour_distance = $postData['tour_distance'];
            $tour->countries = $postData['countries'];
        } else {
            $tour = new Tour([
                'user_id' => $userId,
                'title' => $postData['title'],
                'riding_style' => $postData['riding_style'],
                'riding_style_info' => $postData['riding_style_info'],
                'rider_capability' => $postData['rider_capability'],
                'rider_capability_info' => $postData['rider_capability_info'],
                'duration_days' => $postData['duration_days'],
                'rest_days' => $postData['rest_days'],
                'max_riders' => $postData['max_riders'],
                'guides' => $postData['guides'],
                'bike_option' => $postData['bike_option'],
                'rent_gear' => $postData['rent_gear'],
                'two_up_riding' => $postData['two_up_riding'],
                'bike_specification' => $postData['bike_specification'],
                'tour_distance' => $postData['tour_distance'],
                'countries' => $postData['countries'],
            ]);
        }
        $tour->save();
        echo json_encode(["message" => "Tour saved successfully", "tour_id" => $tour->id]);
    }

    public function saveSecondStep(Request $request)
    {
        $postData = $request->secondStepData;
        Tour::where('id', $postData['tour_id'])->update(array(
            'tour_description' => $postData['description'],
            'included' => $postData['included'],
            'not_included' => $postData['not_included'],
            'tour_meeting_location_notes' => $postData['tour_meeting_location_notes'],
            'tour_start_location' => $postData['tour_start_location'],
        ));
        echo json_encode(["message" => "Tour saved successfully", "tour_id" => $postData['tour_id']]);
    }

    public function saveThirdStep(Request $request)
    {
        $postData = $request->thirdStepData;
        Tour::where('id', $postData['tour_id'])->update(array(
            'video_one' => $postData['video_link_one'],
            'video_two' => $postData['video_link_two'],
            'video_three' => $postData['video_link_three'],
        ));
        echo json_encode(["message" => "Tour saved successfully", "tour_id" => $postData['tour_id']]);
    }

    public function saveFourthStep(Request $request)
    {
        $tour_id = $request->tour_id;
        $addonValues = $request->addonValues;
        if ($addonValues != null) {
            $filteredaddonValues = array_filter($addonValues, function ($element) {
                return !empty($element);
            });
            TourAddOn::where('tour_id', $tour_id)->delete();
            foreach ($filteredaddonValues as $addOn) {
                if (is_array($addOn) && count($addOn) > 0 && isset($addOn['addon']) && isset($addOn['price']) && $addOn['addon'] != null && $addOn['price'] != null) {
                    TourAddOn::create([
                        'addon' => $addOn['addon'],
                        'addon_price' => $addOn['price'],
                        'tour_id' => $tour_id,
                    ]);
                }
            }
        }
        $dateValues = $request->dateValues;
        if ($dateValues != null) {
            $filteredDateValues = array_filter($dateValues, function ($element) {
                return !empty($element);
            });
            TourPrice::where('tour_id', $tour_id)->delete();
            foreach ($filteredDateValues as $date) {
                if (is_array($date) && count($date) > 0 && isset($date['date']) && isset($date['qty']) && $date['date'] != null && $date['qty'] != null) {
                    TourPrice::create([
                        'date' => $date['date'],
                        'price' => $date['qty'],
                        'tour_id' => $tour_id,
                    ]);
                }
            }
        }
        echo json_encode(["message" => "Tour saved successfully", "tour_id" => $tour_id]);
    }

    function bookTour(Request $request)
    {
        $bookingData = $request->all();
        $bookingData['user_id'] = auth()->user()->id;
        $bookingCreated = Booking::create($bookingData);
        $booking = Booking::select([
            'tours.title',
            'tours.rider_capability',
            'tours.duration_days',
            'tours.max_riders',
            'tours.guides',
            'bookings.date',
            'bookings.id',
            'tours.title',
            'bookings.name',
            'bookings.dob',
            'bookings.nationality',
            'bookings.driving_license_number',
            'bookings.mobile_number',
            'bookings.address',
            'bookings.country',
            'bookings.postcode',
            'bookings.amount',
            'tours.tour_distance',
            'bookings.created_at',
        ])->where('bookings.id', $bookingCreated->id)->leftJoin('tours', 'bookings.tour_id', 'tours.id')->get();
        $tour = Tour::find($bookingCreated->tour_id);
        $user = User::find($tour->user_id);
        Mail::to($user->email)->send(new BookingConfirmedAgency($booking));
        Mail::to(auth()->user()->email)->send(new BookingConfirmed($booking));
        echo json_encode(["message" => "Booking saved successfully", "booking" => $booking]);
    }

    function markFavourite(Request $request)
    {
        $bookingData = $request->all();
        $bookingData['user_id'] = auth()->user()->id;
        $favouriteTour = FavouriteTour::create($bookingData);
        echo json_encode(["message" => "Tour marked as favourite.!", "favouriteTour" => $favouriteTour]);
    }

    function deleteFavourite(Request $request)
    {
        $tour_id = $request->tour_id;
        $user_id = auth()->user()->id;
        FavouriteTour::where('tour_id', $tour_id)->where('user_id', $user_id)->delete();
        echo json_encode(["message" => "Tour removed from favourite.!"]);
    }

    function profile(Request $request)
    {
        return view('tour.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $request->user()->fill($request->all());
        $request->user()->tour_operation_name = $request->tour_operation_name;
        $request->user()->tour_profile_picture = $request->tour_profile_picture;
        $request->user()->tour_contact_number = $request->tour_contact_number;
        $request->user()->tour_address = $request->tour_address;
        $request->user()->tour_country = $request->tour_country;
        $request->user()->tour_pincode = $request->tour_pincode;
        $request->user()->tour_contact_email = $request->tour_contact_email;
        $request->user()->tour_currency = $request->tour_currency;

        if ($request->hasFile('tour_profile_picture')) {
            $profilePicturePath = $request->file('tour_profile_picture')->store('uploads', 'public');
            $request->user()->tour_profile_picture = $profilePicturePath;
        }

        $request->user()->save();

        return Redirect::route('tours.profile')->with('status', 'profile-updated');
    }

    public function updateSettings(Request $request)
    {
        // If tour setting exists then update otherwise create a new setting
        TourSetting::updateOrInsert(['user_id' => $request->user()->id], [
            'bank_name' => $request->bank_name,
            'bank_country' => $request->bank_country,
            'iban' => $request->iban,
            'swift' => $request->swift,
            'account_number' => $request->account_number,
            'sort_code' => $request->sort_code,
            'account_name' => $request->account_name,
        ]);
        return Redirect::route('tours.settings.update')->with('status', 'profile-updated');
    }

    function tourSettings(Request $request)
    {
        return view('tour.profile.creation-settings', [
            'tour_setting' => TourSetting::where('user_id', $request->user()->id)->first(),
        ]);
    }

    function answerQuestion(Request $request, $questionId)
    {
        $question = TourQuestion::find($questionId);
        $question->answer = $request->answer;
        $question->answered_by = auth()->user()->id;
        $question->is_answered = true;
        $question->save();
        return redirect()->back();
    }

    function askQuestion(Request $request, $tourId)
    {
        $question = TourQuestion::create([
            'tour_id' => $tourId,
            'question' => $request->question,
            'questioned_by' => auth()->user()->id
        ]);
        return redirect()->back();
    }
}
