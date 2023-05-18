<?php

use App\Http\Controllers\DigestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaticController;
use App\Models\Digest;
use Illuminate\Http\Request;
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

require __DIR__ . '/auth.php';


Route::get('/', function (Request $request) {
    $validatedData = $request->validate([
        'infinite_scroll' => 'nullable|string',
        'page' => 'nullable|string'
    ]);

    $infiniteScroll = isset($validatedData['infinite_scroll']) ? $validatedData['infinite_scroll'] : null;

    $category = $request->input('category');
    $search = $request->input('search');
    $activeCategory = $category;

    $digests = Digest::with(['category' => function ($query) {
        return $query->select('id', 'name');
    }])
        ->when($category, function ($query) use ($category) {
            return $query->whereHas('category', function ($query) use ($category) {
                return $query->where('name', $category);
            });
        })
        ->orderBy('-created_at')
        ->paginate(12, ['title', 'body', 'image', 'slug', 'keywords', 'created_at', 'id', 'category_id']);

    $paginationLinks = json_decode($digests->toJson());



    return view('index', compact('digests', 'activeCategory', 'paginationLinks'))->fragment($infiniteScroll ? 'infinite-scroll-content' : '');
})->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::resource('digest', DigestController::class);
Route::middleware(['auth', 'can:create-digest'])->group(function () {
    Route::post('/digests', [DigestController::class, 'store'])->name('digest.store');
    Route::put('/digests/{slug}', [DigestController::class, 'update'])->name('digest.update');
});
Route::get('/today', [DigestController::class, 'today'])->name('digest.today');
Route::get('/digest/{slug}', [DigestController::class, 'show'])->name('digest.show');
Route::post('/search', [DigestController::class, 'search'])->name('search-digests');


Route::get('about-us', [StaticController::class, 'aboutUs'])->name('about-us');
Route::get('contact-us', [StaticController::class, 'contactUs'])->name('contact-us');
Route::get('terms-and-conditions', [StaticController::class, 'termsAndConditions'])->name('terms-and-conditions');
Route::get('privacy-policy', [StaticController::class, 'privacyPolicy'])->name('privacy-policy');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::any('{query}', function () {
    return redirect(route('home'));
})->where('query', '.*');
