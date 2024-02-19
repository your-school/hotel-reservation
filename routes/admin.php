<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\AdminContactController;
use App\Http\Controllers\AdminHotelController;
use App\Http\Controllers\AdminReserverController;
use App\Http\Controllers\ReservationsController;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});


Route::get('/', function () {
    return view('admin.welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin', 'verified'])->name('dashboard');

Route::middleware('auth:admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/reservation_frames', [ReservationsController::class, 'index'])->name('reservation_frames.index');
    Route::get('/admin/reservation_frames/create', [ReservationsController::class, 'create'])->name('reservation_frames.create');
    Route::post('/admin/reservation_frames/store', [ReservationsController::class, 'store'])->name('reservation_frames.store');
    Route::get('/admin/reservation_frames/edit/{hotelPlan}', [ReservationsController::class, 'edit'])->name('reservation_frames.edit');
    Route::put('/admin/reservation_frames/update/{hotelPlan}', [ReservationsController::class, 'update'])->name('reservation_frames.update');
    Route::delete('/admin/reservation_frames/{hotelPlan}', [ReservationsController::class, 'destroy'])->name('reservation_frames.destroy');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/hotels', [AdminHotelController::class, 'index'])->name('hotels.index');
    Route::get('/admin/hotels/create', [AdminHotelController::class, 'create'])->name('hotels.create');
    Route::post('/admin/hotels/store', [AdminHotelController::class, 'store'])->name('hotels.store');
    Route::get('/admin/hotels/edit/{hotel}', [AdminHotelController::class, 'edit'])->name('hotels.edit');
    Route::put('/admin/hotels/update/{hotel}', [AdminHotelController::class, 'update'])->name('hotels.update');
    Route::delete('/admin/hotels/{hotel}', [AdminHotelController::class, 'destroy'])->name('hotels.destroy');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::get('/admin/contacts/show/{contact}', [AdminContactController::class, 'show'])->name('contacts.show');
    Route::patch('/admin/contacts/update/{contact}', [AdminContactController::class, 'update'])->name('contacts.update');

    // Route::get('/admin/contacts/create', [AdminContactController::class, 'create'])->name('contacts.create');
    // Route::post('/admin/contacts/store', [AdminContactController::class, 'store'])->name('contacts.store');
    // Route::get('/admin/contacts/edit/{hotel}', [AdminContactController::class, 'edit'])->name('contacts.edit');
    // Route::put('/admin/contacts/update/{hotel}', [AdminContactController::class, 'update'])->name('contacts.update');
    // Route::delete('/admin/contacts/{hotel}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/reservers', [AdminReserverController::class, 'index'])->name('reservers.index');
    Route::get('/admin/reservers/search', [AdminReserverController::class, 'search'])->name('reservers.search');
    Route::get('/admin/reservers/show/{id}', [AdminReserverController::class, 'show'])->name('reservers.show');
    Route::delete('/admin/reservers/cancel/{reservation}', [AdminReserverController::class, 'cancel'])->name('reservers.cancel');
    Route::get('/admin/reservers/create', [AdminReserverController::class, 'create'])->name('reservers.create');
    Route::post('/admin/reservers/store', [AdminReserverController::class, 'store'])->name('reservers.store');
    Route::get('/admin/reservers/edit/{reservation}', [AdminReserverController::class, 'edit'])->name('reservers.edit');
    Route::put('/admin/reservers/update/{reservation}', [AdminReserverController::class, 'update'])->name('reservers.update');
    Route::delete('/admin/reservers/{reservation}', [AdminReserverController::class, 'destroy'])->name('reservers.destroy');
});
