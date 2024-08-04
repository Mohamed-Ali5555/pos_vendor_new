<?php

use Illuminate\Support\Facades\Route;

/// this tips you must to write to prevent when using middleware seller/* prevent this -->seller/login when you are login
Route::group(['namespace'=>'Seller','prefix'=>'seller','middleware'=>'guest:seller'],function(){
  Route::get('login',[\App\Http\Controllers\seller\LoginController::class,'show_login_view'])->name('seller.showlogin');
        // dd('ggg');

    Route::post('login',[\App\Http\Controllers\seller\LoginController::class,'login'])->name('seller.login');

});



Route::group(['prefix'=>'seller','middleware'=>'auth:seller'],function(){
//     Route::get('logout',function(){
//       auth()->logout();
//   });

  Route::get('/',[\App\Http\Controllers\seller\indexController::class,'index'])->name('seller');
  //product section
  Route::resource('seller-product',\App\Http\Controllers\Seller\ProductController::class);
  Route::post('seller_product/status',[\App\Http\Controllers\Seller\ProductController::class,'productStatus'])->name('seller.product.status');
 
  Route::delete('productAttribute/{id}',[\App\Http\Controllers\Seller\ProductController::class,'attributeDelete'])->name('seller.productAttribute.destroy');
});