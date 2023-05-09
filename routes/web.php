<?php

use App\Http\Controllers\DigestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaticController;
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
    return view('index', ['msg' => 'all digests']);
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('digest', DigestController::class);
Route::get('/today', [DigestController::class, 'today'])->name('digest.today');


Route::get('about-us', [StaticController::class, 'aboutUs'])->name('about-us');
Route::get('contact-us', [StaticController::class, 'contactUs'])->name('contact-us');
Route::get('terms-and-conditions', [StaticController::class, 'termsAndConditions'])->name('terms-and-conditions');
Route::get('privacy-policy', [StaticController::class, 'privacyPolicy'])->name('privacy-policy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
