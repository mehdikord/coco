<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API front Routes
|--------------------------------------------------------------------------
|
| all Front routes is here
|
*/
Route::get('slider',[\App\Http\Controllers\Front\SliderController::class,'index']);

Route::prefix('categories')->group(function (){
    Route::get('',[\App\Http\Controllers\Front\CategoryController::class,'index']);

});

Route::prefix('products')->group(function (){

Route::get('',[\App\Http\Controllers\Front\ProductController::class,'index']);
Route::get('comments/{code}',[\App\Http\Controllers\Front\ProductController::class,'comments']);
Route::get('{code}/{name}',[\App\Http\Controllers\Front\ProductController::class,'show']);

});

Route::get('brands',[\App\Http\Controllers\Front\BrandController::class,'index']);

Route::prefix('helper')->group(function (){

    Route::prefix('shopping')->group(function (){
        Route::get('shipping',[\App\Http\Controllers\Helper\HelperController::class,'shipping']);
    });

    Route::get('provinces',[\App\Http\Controllers\Helper\HelperController::class,'provinces']);

});

Route::prefix('system')->as('system.')->group(function (){

    //Payments gateway callbacks
    Route::prefix('payments/callback')->as('payments.callback.')->group(function (){

        Route::post('bitpay',[\App\Http\Controllers\Front\System\PaymentCallbackController::class,'bitpay'])->name('bitpay');

    });



});



