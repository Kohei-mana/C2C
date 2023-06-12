<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShowProducts;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ExhibitController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [ShowProducts::class, 'show'])
    ->name('home');

Route::get('/', [ShowProducts::class, 'search'])
    ->name('search-product');

Route::get('/product-detail/{id}', [ShowProducts::class, 'showDetail'])
    ->name('product-detail');

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
        $exhibit_products = Product::where('user_id', Auth::id())->orderBy('created_at', 'asc')->get();
        return view('listing_history', compact('exhibit_products'));
    })->name('listing_history');
    Route::get('/exhibition-product/{id}', [ExhibitController::class, 'show'])->name('exhibition-product');
    Route::get('/purchase_history', function () {
        return view('purchase_history');
    })->name('purchase_history');
    Route::get('/exhibit', [ExhibitController::class, 'exhibitPage'])->name('exhibit');
    Route::post('/confirm-exhibit', [ExhibitController::class, 'confirmExhibitPage'])->name('confirm-exhibit');
    Route::get('/complete-exhibit', [ExhibitController::class, 'store'])->name('complete-exhibit');
});

require __DIR__ . '/auth.php';
