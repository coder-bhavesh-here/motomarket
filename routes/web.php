<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TourController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProfileController::class, 'home']);
Route::get('/tour/{tourId}', [TourController::class, 'show']);
Route::get('/tour/book/{tourId}', [TourController::class, 'book']);

Route::get('/dashboard', [ProfileController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/tours', [TourController::class, 'index'])->name('tours');
    Route::get('/book/{priceId}', [TourController::class, 'book'])->name('book');
    Route::post('/book', [TourController::class, 'bookTour'])->name('bookTour');
    Route::get('/my-tours', [TourController::class, 'myTours'])->name('my-tours');
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
});

require __DIR__ . '/auth.php';
