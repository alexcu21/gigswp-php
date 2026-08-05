<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;
use App\Models\Listing;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/listings', [ListingController::class, 'index'])->name('listings.index');
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth')->name('listings.create');
Route::get('/listings/edit/{listing}', [ListingController::class, 'edit'])->middleware('auth')->name('listings.edit');
Route::get('/listings/{listing}', [ListingController::class, 'show'])->name('listings.show');
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth')->name('listings.store');
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth')->name('listings.update');
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth')->name('listings.destroy');

Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'database' => config('database.connections.mysql.database'),
        'listings' => Listing::query()->count(),
    ]);
})->name('health');

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
