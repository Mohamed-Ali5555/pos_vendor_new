<?php

use Illuminate\Support\Facades\Route;
Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>'guest:admin'],function(){
  Route::get('login',[\App\Http\Controllers\Admin\loginController::class,'show_login_view'])->name('admin.showlogin');
  Route::post('login',[\App\Http\Controllers\Admin\loginController::class,'login'])->name('admin.login');

});
// Route::group(['prefix'=>'admin'],function(){
//   // return 'gg';
//     Route::get('login',[\App\Http\Controllers\Admin\LoginController::class,'show_login_view'])->name('admin.showlogin');
//     Route::post('login',[\App\Http\Controllers\Admin\LoginController::class,'login'])->name('admin.login');

// });



Route::group(['prefix'=>'admin','middleware'=>'auth:admin'],function(){
    Route::get('logout',function(){
      auth()->logout();
  });

  Route::get('/',[\App\Http\Controllers\Admin\AdminController::class,'index'])->name('admin');

  ////category section/////
  Route::resource('category',\App\Http\Controllers\CategoryController::class);
  Route::post('category_status',[\App\Http\Controllers\CategoryController::class,'categoryStatus'])->name('category.status');
  Route::post('category/{id}/child',[\App\Http\Controllers\CategoryController::class,'getChildByParent']);
  //// brand section////
  Route::resource('brand',\App\Http\Controllers\BrandController::class);
  Route::post('brand_status',[\App\Http\Controllers\BrandController::class,'brandStatus'])->name('brand.status');
  //// brand section////
  Route::resource('banner',\App\Http\Controllers\BannerController::class);
  Route::post('banner_status',[\App\Http\Controllers\BannerController::class,'bannerStatus'])->name('banner.status');
  //// product section////
  Route::resource('product',\App\Http\Controllers\productController::class);
  Route::post('product_status',[\App\Http\Controllers\productController::class,'productStatus'])->name('product.status');
  Route::post('product-attribute/{id}',[\App\Http\Controllers\ProductController::class,'addProductAttribute'])->name('product.attribute');
  Route::delete('productAttribute/{id}',[\App\Http\Controllers\ProductController::class,'attributeDelete'])->name('productAttribute.destroy');
  //// coupon section ///
  Route::resource('coupon',\App\Http\Controllers\CouponController::class);
  Route::post('coupon_status',[\App\Http\Controllers\CouponController::class,'couponStatus'])->name('coupon.status');
  //// shipping section ///
  Route::resource('shipping',\App\Http\Controllers\shippingController::class);
  Route::post('shipping_status',[\App\Http\Controllers\shippingController::class,'shippingStatus'])->name('shipping.status');
  //// currencie section ///
  Route::resource('currencie',\App\Http\Controllers\CurrencieController::class);
  Route::post('currencie_status',[\App\Http\Controllers\CurrencieController::class,'currencieStatus'])->name('currencie.status');
  //// about us
  Route::get('aboutus',[\App\Http\Controllers\AboutusController::class,'index'])->name('aboutus');
  Route::put('aboutus-update',[\App\Http\Controllers\AboutusController::class,'Update'])->name('aboutus.update');

  ///order section //
  Route::resource('order',\App\Http\Controllers\OrderController::class);
  Route::post('order_status',[\App\Http\Controllers\OrderController::class,'orderStatus'])->name('order.status');
 
 
  ///order section //
  Route::resource('seller',\App\Http\Controllers\SellerController::class);
  Route::post('seller_status',[\App\Http\Controllers\SellerController::class,'sellerStatus'])->name('seller.status');
  Route::post('seller_verified',[\App\Http\Controllers\SellerController::class,'sellerverified'])->name('seller.verified');

  //setting section
  Route::get('settings',[\App\Http\Controllers\SettingController::class,'settings'])->name('settings');
  Route::put('settings',[\App\Http\Controllers\SettingController::class,'settingUpdate'])->name('setting.update');
  
  //SMTP SETTINGS SECTION
  Route::get('smtp',[\App\Http\Controllers\SettingController::class,'smtp'])->name('smtp');
  Route::post('smtp-update',[\App\Http\Controllers\SettingController::class,'smtpUpdate'])->name('smtp.update');
    //user section
    Route::resource('user',\App\Http\Controllers\UserController::class);
    // Brand status 
    Route::post('user.status',[\App\Http\Controllers\UserController::class,'userStatus'])->name('user.status');

});
Route::group(['prefix' => 'filemanager', 'middleware' => ['web','auth:admin']], function () {
  \UniSharp\LaravelFilemanager\Lfm::routes();
});