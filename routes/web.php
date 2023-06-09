<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ExhibitController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/favorite', function () {
        return view('favorite');
    })->name('favorite');
    Route::get('/listing_history', function () {
        return view('listing_history');
    })->name('listing_history');
    Route::get('/purchase_history', function () {
        return view('purchase_history');
    })->name('purchase_history');
    Route::get('/exhibit', [ExhibitController::class, 'exhibitPage'])->name('exhibit');
    Route::post('/confirm-exhibit', [ExhibitController::class, 'confirmExhibitPage'])->name('confirm-exhibit');
    Route::get('/complete-exhibit', [ExhibitController::class, 'store'])->name('complete-exhibit');
});

require __DIR__ . '/auth.php';
