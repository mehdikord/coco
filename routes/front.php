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


});

Route::get('brands',[\App\Http\Controllers\Front\BrandController::class,'index']);

