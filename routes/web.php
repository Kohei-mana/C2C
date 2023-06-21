<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShowProducts;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ExhibitController;
use App\Http\Controllers\PurchaseController;

use App\Models\Favorite;

use Illuminate\Support\Facades\Route;
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

Route::get('/searched', [ShowProducts::class, 'search'])
    ->name('search-product');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['verified'])->name('dashboard');


Route::middleware('auth')->group(function () {

    Route::get('/', [ShowProducts::class, 'show'])
    ->name('home');

    Route::get('/searched', [ShowProducts::class, 'search'])
        ->name('search-product');

    Route::get('/product-detail/{id}', [ShowProducts::class, 'showDetail'])
        ->name('product-detail');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/favorite', [FavoriteController::class, 'showFavoriteProducts'])->name('favorite');

    Route::get('/listing_history', [ExhibitController::class, 'showAll'])->name('listing_history');

    Route::get('/exhibition-product/{id}', [ExhibitController::class, 'showSpecific'])->name('exhibition-product');
    Route::post('/update-listing/{id}', [ExhibitController::class, 'updateListing'])->name('updateListing');

    Route::get('/purchase_history', [PurchaseController::class, 'showHistory'])->name('purchase_history');

    Route::get('/exhibit', [ExhibitController::class, 'create'])->name('exhibit');
    Route::post('/confirm-exhibit', [ExhibitController::class, 'confirm'])->name('confirm-exhibit');
    Route::post('/complete-exhibit', [ExhibitController::class, 'store'])->name('complete-exhibit');

    Route::get('/product-detail/{id}', [ShowProducts::class, 'showDetail'])
        ->name('product-detail');

    // // いいね
    Route::get('/product-detail/favorite/{product}', [FavoriteController::class, 'makeFavorite'])->name('addfavorite');
    Route::get('/product-detail/notfavorite/{product}', [FavoriteController::class, 'removeFavorite'])->name('notfavorite');

    //カートに追加
    Route::get('/product-detail//{product}', [PurchaseController::class, 'addToCart'])
        ->name('add_to_cart');

    //カートに移動
    Route::get('/shopping_cart', [PurchaseController::class, 'shoppingCartPage'])
        ->name('shopping_cart');
    //カートから削除
    Route::get('/shopping_cart/deleted', [PurchaseController::class, 'removeFromCart'])
        ->name('remove_from_cart');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    Route::get('/input-shipping-address', [PurchaseController::class, 'inputShippingAddress'])->name('input-shipping-address');
    Route::post('/input-payment-information', [PurchaseController::class, 'inputPaymentInformation'])->name('input-payment-information');
    Route::post('/complete-purchase', [ExhibitController::class, 'store'])->name('complete-purchase');
});


require __DIR__ . '/auth.php';
