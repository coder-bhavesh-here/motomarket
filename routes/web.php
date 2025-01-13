<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TourController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProfileController::class, 'home'])->name('homepage');
Route::get('/explore-tours', [ProfileController::class, 'exploreTours'])->name('explore-tours');
Route::get('/', [ProfileController::class, 'home'])->name('dashboard');
Route::get('/tour/{tourId}', [TourController::class, 'show']);
Route::post('/mark-as-favourite', [TourController::class, 'markFavourite']);
Route::post('/delete-favourite', [TourController::class, 'deleteFavourite']);
Route::get('/tour/book/{tourId}', [TourController::class, 'book']);

Route::get('/dashboard', [ProfileController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboards');

Route::get('/blogs', [BlogController::class, 'list'])->name('blogs.list');
Route::get('/faqs', [BlogController::class, 'faqList'])->name('faqs.list');
Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');
Route::middleware('auth')->group(function () {
    Route::get('/tours', [TourController::class, 'index'])->name('tours');
    Route::get('/tour-profile', [TourController::class, 'profile'])->name('tours.profile');
    Route::patch('/tour-profile', [TourController::class, 'updateProfile'])->name('tours.profile.update');
    Route::get('/tour-settings', [TourController::class, 'tourSettings'])->name('tours.settings');
    Route::patch('/tour-settings', [TourController::class, 'updateSettings'])->name('tours.settings.update');
    Route::get('/book/{priceId}', [TourController::class, 'book'])->name('book');
    Route::post('/book', [TourController::class, 'bookTour'])->name('bookTour');
    Route::get('/my-tours', [TourController::class, 'myTours'])->name('my-tours');
    Route::get('/my-favourite-tours', [TourController::class, 'myFavouriteTours'])->name('my-favourite-tours');
    Route::get('/bookings', [TourController::class, 'bookings'])->name('bookings');
    Route::get('/tours/create', [TourController::class, 'create'])->name('tours.create');
    Route::post('/tours/upload_image', [TourController::class, 'uploadImage'])->name('tours.upload');
    Route::post('/tours/publish_tour', [TourController::class, 'publishTour'])->name('tours.publish');
    Route::post('/tours/delete_image}', [TourController::class, 'deleteImage'])->name('tourImage.delete');
    Route::post('/tours/save-tour/firstStep', [TourController::class, 'saveFirstStep']);
    Route::post('/tours/save-tour/secondStep', [TourController::class, 'saveSecondStep']);
    Route::post('/tours/save-tour/thirdStep', [TourController::class, 'saveThirdStep']);
    Route::post('/tours/save-tour/fourthStep', [TourController::class, 'saveFourthStep']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/tour-questions/ask/{tourId}', [TourController::class, 'askQuestion'])->name('tour-questions.ask');
    Route::post('/tour-questions/answer/{questionId}', [TourController::class, 'answerQuestion'])->name('tour-questions.answer');
});

require __DIR__ . '/auth.php';
