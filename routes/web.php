<?php

use App\Http\Controllers\DigestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaticController;
use App\Models\Digest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

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


Route::get('/', function (Request $request) {
    $validatedData = $request->validate([
        'infinite_scroll' => 'nullable|string',
        'page' => 'nullable|string'
    ]);

    $infiniteScroll = isset($validatedData['infinite_scroll']) ? $validatedData['infinite_scroll'] : null;

    $category = $request->input('category');
    $search = $request->input('search');
    $activeCategory = $category;

    $digests = Digest::queryDigests($category);

    $paginationLinks = json_decode($digests->toJson());


    return view('index', compact('digests', 'activeCategory', 'paginationLinks'))->fragment($infiniteScroll ? 'infinite-scroll-content' : '');
})->name('home')->middleware(['throttle:15,1']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('digest', DigestController::class)->only(['update']);


Route::middleware(['auth', 'can:create-digest', 'throttle:15,1'])->group(function () {
    Route::patch('digest/publish/{digest}', [DigestController::class, 'toPublish'])->name('digest.toPublish');
    Route::post('/digests', [DigestController::class, 'store'])->name('digest.store');
    Route::delete('/digests/{slug}', [DigestController::class, 'destroy'])->name('digest.destroy');
});


Route::get('/today', [DigestController::class, 'today'])->name('digest.today')->middleware(['throttle:15,1']);
Route::get('/digest/{slug}', [DigestController::class, 'show'])->name('digest.show')->middleware(['throttle:15,1']);
Route::post('/search', [DigestController::class, 'search'])->name('search-digests')->middleware(['throttle:15,1']);


Route::get('about-us', [StaticController::class, 'aboutUs'])->name('about-us')->middleware(['throttle:15,1']);
// Route::get('contact-us', [StaticController::class, 'contactUs'])->name('contact-us');
Route::get('terms-and-conditions', [StaticController::class, 'termsAndConditions'])->name('terms-and-conditions')->middleware(['throttle:15,1']);
Route::get('privacy-policy', [StaticController::class, 'privacyPolicy'])->name('privacy-policy')->middleware(['throttle:15,1']);

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('/akhdemta3lkhadmasahbi', function () {
    $sitemap = Sitemap::create()
        ->add(Url::create(route('home'))->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_HOURLY))
        ->add(Url::create('/today')->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_HOURLY))
        ->add(Url::create(route('about-us'))->setPriority(0.3)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
        ->add(Url::create(route('privacy-policy'))->setPriority(0.3)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
        ->add(Url::create(route('terms-and-conditions'))->setPriority(0.3)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));
    -
    /** Now you haved added custom URL's, now add dynamic URL's for SEO */
    $digests = Digest::published()->get();
    foreach ($digests as $digest) {
        $sitemap->add(Url::create("/digest/{$digest->slug}")->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));
    }
    $sitemap->writeToFile(public_path('sitemap.xml'));

    return response()->json([
        'ok' => 201
    ]);
});

require __DIR__ . '/auth.php';

Route::any('{query}', function () {
    return redirect(route('home'));
})->where('query', '.*');
