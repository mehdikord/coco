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

