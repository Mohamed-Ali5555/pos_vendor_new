<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });


Route::get('/',[\App\Http\Controllers\frontend\IndexController::class,'home'])->name('home');
Route::get('product-detail/{slug}/',[\App\Http\Controllers\frontend\IndexController::class,'productDetail'])->name('product.detail');
Route::get('product-category/{slug}/',[\App\Http\Controllers\frontend\IndexController::class,'productCategory'])->name('product.category');




//cart section 
Route::get('cart',[\App\Http\Controllers\frontend\CartController::class,'cart'])->name('cart');
Route::post('cart/store',[\App\Http\Controllers\frontend\CartController::class,'cartStore'])->name('cart.store');
Route::post('cart/delete',[\App\Http\Controllers\frontend\CartController::class,'cartDelete'])->name('cart.delete');
Route::post('cart/update',[\App\Http\Controllers\frontend\CartController::class,'cartUpdate'])->name('cart.update');

// wishlist sectoion
Route::get('wishlist',[\App\Http\Controllers\frontend\WishlistController::class,'wishlist'])->name('wishlist');
Route::post('wishlist/store',[\App\Http\Controllers\frontend\WishlistController::class,'wishlistStore'])->name('wishlist.store');
Route::post('wishlist/delete',[\App\Http\Controllers\frontend\WishlistController::class,'wishlistDelete'])->name('wishlist.delete');
Route::post('wishlist/cart',[\App\Http\Controllers\frontend\WishlistController::class,'moveToCart'])->name('move.cart');

/// compare section
Route::get('compare',[\App\Http\Controllers\frontend\CompareController::class,'compare'])->name('compare');
Route::post('compare/store',[\App\Http\Controllers\frontend\CompareController::class,'compareStore'])->name('compare.store');
Route::post('compare/delete',[\App\Http\Controllers\frontend\CompareController::class,'compareDelete'])->name('compare.delete');
Route::post('compare/move-to-wishlist',[\App\Http\Controllers\frontend\CompareController::class,'moveToWishlist'])->name('compare.move.wishlist');
Route::post('compare/move-to-cart',[\App\Http\Controllers\frontend\CompareController::class,'moveToCart'])->name('compare.move.cart');

/// shop section
Route::get('shop',[\App\Http\Controllers\frontend\IndexController::class,'shop'])->name('shop');
Route::post('shop-filter',[\App\Http\Controllers\frontend\IndexController::class,'shopFilter'])->name('shop.filter');
/// search

Route::get('search',[\App\Http\Controllers\frontend\IndexController::class,'search'])->name('search');
Route::get('autosearch',[\App\Http\Controllers\frontend\IndexController::class,'autoSearch'])->name('autosearch');

//// currncy change route 
Route::post('currency_load',[\App\Http\Controllers\CurrencieController::class,'currencyLoad'])->name('currency.load');
