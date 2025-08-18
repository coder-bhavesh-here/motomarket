<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\EmergencyContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TourController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:6,1')->group(function () {
    Route::get('/about', function () {
        return view('about');
    });
});
Route::middleware('throttle:6,1')->group(function () {
    Route::get('/invite-operators', function () {
        return view('invite-operators');
    });
});
Route::middleware('throttle:6,1')->group(function () {
    Route::get('/investor', function () {
        return view('investor');
    });
});
Route::middleware('throttle:6,1')->group(function () {
    Route::get('/partner', function () {
        return view('partner');
    });
});
Route::middleware('throttle:6,1')->group(function () {
    Route::get('/user/{nickname}', [ProfileController::class, 'showUser']);
});
Route::middleware('throttle:6,1')->group(function () {
    Route::get('/tour-operator/{nickname}', [ProfileController::class, 'showTourUser']);
});
Route::middleware('throttle:6,1')->group(function () {
    Route::get('/verify', [ProfileController::class, 'verifyEmail'])->name('verifyEmail');
});
Route::middleware('throttle:6,1')->group(function () {
    Route::post('/payment', [TourController::class, 'makePayment'])->name('makePayment');
});
Route::middleware('throttle:6,1')->group(function () {
    Route::get('/', [ProfileController::class, 'newHome'])->name('homepage');
});
Route::middleware('throttle:6,1')->group(function () {
    Route::redirect('/dashboard', '/')->name('dashboard');
});
Route::middleware('throttle:6,1')->group(function () {
    Route::get('/explore-tours', [ProfileController::class, 'exploreTours'])->name('explore-tours');
});
Route::middleware('throttle:6,1')->group(function () {
    Route::get('/tour/{tourId}', [TourController::class, 'show']);
});
Route::middleware('throttle:6,1')->group(function () {
    Route::post('/mark-as-favourite', [TourController::class, 'markFavourite']);
});
Route::middleware('throttle:6,1')->group(function () {
    Route::post('/delete-favourite', [TourController::class, 'deleteFavourite']);
});
Route::middleware('throttle:6,1')->group(function () {
    Route::get('/tour/book/{tourId}', [TourController::class, 'book']);
});

Route::middleware('throttle:6,1')->group(function () {
    Route::get('/blogs', [BlogController::class, 'list'])->name('blogs.list');
});
Route::middleware('throttle:6,1')->group(function () {
    Route::get('/faqs', [BlogController::class, 'faqList'])->name('faqs.list');
});
Route::middleware('throttle:6,1')->group(function () {
    Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::get('/tour-management', [ProfileController::class, 'tourManagement'])->name('tour-management');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::get('/draft-tour-management', [ProfileController::class, 'draftTourManagement'])->name('draft-tour-management');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::get('/hidden-tour-management', [ProfileController::class, 'hiddenTourManagement'])->name('hidden-tour-management');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::get('/deleted-tour-management', [ProfileController::class, 'deletedTourManagement'])->name('deleted-tour-management');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::get('/tours', [TourController::class, 'index'])->name('tours');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::get('/profiles', [ProfileController::class, 'profiles'])->name('profiles');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::get('/emergency-contacts', [EmergencyContactController::class, 'edit'])->name('emergency-contacts.edit');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::post('/emergency-contacts', [EmergencyContactController::class, 'update'])->name('emergency-contacts.update');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::post('/update-tour-profile-status', [ProfileController::class, 'updateTourProfileStatus']);
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::get('/tour-profile', [TourController::class, 'profile'])->name('tours.profile');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::patch('/tour-profile', [TourController::class, 'updateProfile'])->name('tours.profile.update');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::get('/tour-settings', [TourController::class, 'tourSettings'])->name('tours.settings');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::patch('/tour-settings', [TourController::class, 'updateSettings'])->name('tours.settings.update');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::get('/bookAddon/{tourId}', [TourController::class, 'bookAddon']);
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::get('/book/{priceId}', [TourController::class, 'book'])->name('book');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::get('/details/{bookingId}', [TourController::class, 'details'])->name('details');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::post('/book', [TourController::class, 'bookTour'])->name('bookTour');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::get('/my-tours', [TourController::class, 'myTours'])->name('my-tours');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::get('/my-favourite-tours', [TourController::class, 'myFavouriteTours'])->name('my-favourite-tours');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::get('/your-tours', [TourController::class, 'yourTours'])->name('your-tours');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::get('/bookings', [TourController::class, 'bookings'])->name('bookings');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::get('/tours/create', [TourController::class, 'create'])->name('tours.create');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::get('/tours/delete/{tourId}', [TourController::class, 'delete'])->name('tours.delete');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::get('/tours/restore/{tourId}', [TourController::class, 'restore'])->name('tours.restore');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::get('/tours/permDelete/{tourId}', [TourController::class, 'permDelete'])->name('tours.permDelete');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::get('/tours/cancel/{tourId}', [TourController::class, 'cancel'])->name('tours.cancel');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::post('/tours/upload_image', [TourController::class, 'uploadImage'])->name('tours.upload');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::delete('/tours/images/{id}', [TourController::class, 'deleteImage']);
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::post('/tours/publish_tour', [TourController::class, 'publishTour'])->name('tours.publish');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::post('/tours/delete_image}', [TourController::class, 'deleteImage'])->name('tourImage.delete');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::post('/tours/save-tour/firstStep', [TourController::class, 'saveFirstStep']);
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::post('/tours/save-tour/secondStep', [TourController::class, 'saveSecondStep']);
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::post('/tours/save-tour/thirdStep', [TourController::class, 'saveThirdStep']);
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::post('/tours/save-tour/fourthStep', [TourController::class, 'saveFourthStep']);
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::post('/tours/save-tour/fifthStep', [TourController::class, 'saveFifthStep']);
});

Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::get('/tour-profile', [ProfileController::class, 'editTourProfile'])->name('tour-profile.edit');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::patch('/profile-update', [ProfileController::class, 'updated'])->name('profile.updates');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::patch('/tour-profile-update', [ProfileController::class, 'tourProfileUpdated'])->name('tour-profile.updates');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::get('/payment/edit', [ProfileController::class, 'paymentEdit'])->name('payment.edit');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::post('/payment/update', [ProfileController::class, 'paymentUpdate'])->name('payment.update');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::post('/tour-questions/ask/{tourId}', [TourController::class, 'askQuestion'])->name('tour-questions.ask');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::post('/tour-questions/answer/{questionId}', [TourController::class, 'answerQuestion'])->name('tour-questions.answer');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::post('/update-profile-picture', [ProfileController::class, 'updateProfilePicture'])->name('update.profile.picture');
});
Route::middleware(['auth', 'throttle:5,6'])->group(function () {
    Route::post('/update-tour-picture', [ProfileController::class, 'updateTourPicture'])->name('update.tour.picture');
});

Route::get('/payment/success', [TourController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/cancel', [TourController::class, 'paymentCancel'])->name('payment.cancel');

require __DIR__ . '/auth.php';
