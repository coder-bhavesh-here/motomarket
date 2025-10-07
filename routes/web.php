<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\EmergencyContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TourController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:60,1')->group(function () {
    Route::get('/about', function () {
        return view('about');
    });
    Route::get('/invite-operators', function () {
        return view('invite-operators');
    });
    Route::get('/investor', function () {
        return view('investor');
    });
    Route::get('/partner', function () {
        return view('partner');
    });
    Route::get('/user/{nickname}', [ProfileController::class, 'showUser']);
    Route::get('/tour-operator/{nickname}', [ProfileController::class, 'showTourUser']);
    Route::get('/verify', [ProfileController::class, 'verifyEmail'])->name('verifyEmail');
    Route::post('/payment', [TourController::class, 'makePayment'])->name('makePayment');
    Route::get('/', [ProfileController::class, 'newHome'])->name('homepage');
    Route::redirect('/dashboard', '/')->name('dashboard');
    Route::get('/explore-tours', [ProfileController::class, 'exploreTours'])->name('explore-tours');
    Route::get('/tour/{tourId}', [TourController::class, 'show'])->name('tour.show');
    Route::post('/mark-as-favourite', [TourController::class, 'markFavourite']);
    Route::post('/delete-favourite', [TourController::class, 'deleteFavourite']);
    Route::post('/delete-incomplete', [TourController::class, 'deleteIncomplete']);
    Route::get('/tour/book/{tourId}', [TourController::class, 'book']);

    Route::get('/blogs', [BlogController::class, 'list'])->name('blogs.list');
    Route::get('/faqs', [BlogController::class, 'faqList'])->name('faqs.list');
    Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');
});
Route::middleware(['auth', 'throttle:60,1'])->group(function () {
    // Route::post('/profile', function () {
    //     dd('route matched');
    // });
    Route::get('/tour-management', [ProfileController::class, 'tourManagement'])->name('tour-management');
    Route::get('/draft-tour-management', [ProfileController::class, 'draftTourManagement'])->name('draft-tour-management');
    Route::get('/hidden-tour-management', [ProfileController::class, 'hiddenTourManagement'])->name('hidden-tour-management');
    Route::get('/deleted-tour-management', [ProfileController::class, 'deletedTourManagement'])->name('deleted-tour-management');
    Route::get('/tours', [TourController::class, 'index'])->name('tours');
    Route::get('/profiles', [ProfileController::class, 'profiles'])->name('profiles');
    Route::get('/emergency-contacts', [EmergencyContactController::class, 'edit'])->name('emergency-contacts.edit');
    Route::post('/emergency-contacts', [EmergencyContactController::class, 'update'])->name('emergency-contacts.update');
    Route::post('/update-tour-profile-status', [ProfileController::class, 'updateTourProfileStatus']);
    Route::get('/tour-profile', [TourController::class, 'profile'])->name('tours.profile');
    Route::patch('/tour-profile', [TourController::class, 'updateProfile'])->name('tours.profile.update');
    Route::get('/tour-settings', [TourController::class, 'tourSettings'])->name('tours.settings');
    Route::patch('/tour-settings', [TourController::class, 'updateSettings'])->name('tours.settings.update');
    Route::get('/bookAddon/{tourId}', [TourController::class, 'bookAddon']);
    Route::get('/book/{priceId}', [TourController::class, 'book'])->name('book');
    Route::get('/details/{bookingId}', [TourController::class, 'details'])->name('details');
    Route::get('/get-tour-dates/{tourId}', [TourController::class, 'getTourDates'])->name('getTourDates');
    Route::get('/cancel-tour/{bookingId}', [TourController::class, 'cancelTour'])->name('cancel-tour');
    Route::post('/cancel-tour/{bookingId}', [TourController::class, 'cancelTours'])->name('booking.cancel');
    Route::post('/book', [TourController::class, 'bookTour'])->name('bookTour');
    Route::get('/my-tours', [TourController::class, 'myTours'])->name('my-tours');
    Route::get('/my-favourite-tours', [TourController::class, 'myFavouriteTours'])->name('my-favourite-tours');
    Route::get('/my-incomplete-tours', [TourController::class, 'myIncompleteTours'])->name('my-incomplete-tours');
    Route::get('/your-tours', [TourController::class, 'yourTours'])->name('your-tours');
    Route::get('/bookings', [TourController::class, 'bookings'])->name('bookings');
    Route::get('/bookings/{tourId}', [TourController::class, 'bookings'])->name('tour.bookings');
    Route::get('/tours/create', [TourController::class, 'create'])->name('tours.create');
    Route::get('/tours/delete/{tourId}', [TourController::class, 'delete'])->name('tours.delete');
    Route::get('/tours/restore/{tourId}', [TourController::class, 'restore'])->name('tours.restore');
    Route::get('/tours/permDelete/{tourId}', [TourController::class, 'permDelete'])->name('tours.permDelete');
    Route::get('/tours/cancel/{tourId}', [TourController::class, 'cancel'])->name('tours.cancel');
    Route::post('/tours/upload_image', [TourController::class, 'uploadImage'])->name('tours.upload');
    Route::delete('/tours/images/{id}', [TourController::class, 'deleteImage']);
    Route::post('/tours/publish_tour', [TourController::class, 'publishTour'])->name('tours.publish');
    Route::post('/tours/delete_image}', [TourController::class, 'deleteImage'])->name('tourImage.delete');
    Route::post('/tours/save-tour/firstStep', [TourController::class, 'saveFirstStep']);
    Route::post('/tours/save-tour/secondStep', [TourController::class, 'saveSecondStep']);
    Route::post('/tours/save-tour/thirdStep', [TourController::class, 'saveThirdStep']);
    Route::post('/tours/save-tour/fourthStep', [TourController::class, 'saveFourthStep']);
    Route::post('/tours/save-tour/fifthStep', [TourController::class, 'saveFifthStep']);

    Route::get('/tour-profile', [ProfileController::class, 'editTourProfile'])->name('tour-profile.edit');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile-update', [ProfileController::class, 'updated'])->name('profile.updates');
    Route::patch('/tour-profile-update', [ProfileController::class, 'tourProfileUpdated'])->name('tour-profile.updates');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/payment/edit', [ProfileController::class, 'paymentEdit'])->name('payment.edit');
    Route::post('/payment/update', [ProfileController::class, 'paymentUpdate'])->name('payment.update');
    Route::post('/tour-questions/ask/{tourId}', [TourController::class, 'askQuestion'])->name('tour-questions.ask');
    Route::post('/tour-questions/answer/{questionId}', [TourController::class, 'answerQuestion'])->name('tour-questions.answer');
    Route::post('/update-profile-picture', [ProfileController::class, 'updateProfilePicture'])->name('update.profile.picture');
    Route::post('/update-tour-picture', [ProfileController::class, 'updateTourPicture'])->name('update.tour.picture');
});

Route::get('/terms-of-use', [TourController::class, 'termsConditions'])->name('terms-of-user');
Route::get('/privacy-policy', [TourController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/payment/success', [TourController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/cancel', [TourController::class, 'paymentCancel'])->name('payment.cancel');

require __DIR__ . '/auth.php';
