<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\HotelPlanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('user.top');
});

// Route::middleware('auth:users')->group(function () {
//     Route::get('/contact', [ContactController::class, 'index'])->name('contact');
//     Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');
// });
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/hotel-plans', [HotelController::class, 'index'])->name('hotel-plans.index');
Route::post('/hotel-plans/search', [HotelController::class, 'search'])->name('hotel-plans.search');
Route::get('/hotel-plans/{plan}', [HotelController::class, 'show'])->name('hotel-plans.show');
Route::get('/hotel-plans/create/{plan}', [HotelController::class, 'create'])->name('hotel-plans.create');
Route::post('/hotel-plans/store/{plan}', [HotelController::class, 'store'])->name('hotel-plans.store');


Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth:users')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
