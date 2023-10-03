<?php
use Illuminate\Support\Facades\Route;

//Auth
Route::prefix('auth')->group(function (){
    Route::post('',[\App\Http\Controllers\User\Auth\AuthController::class,'login']);
    Route::post('check',[\App\Http\Controllers\User\Auth\AuthController::class,'check']);
});

//Enable Middleware
Route::middleware('auth:users')->group(function (){
    Route::prefix('address')->group(function (){
        Route::get('',[\App\Http\Controllers\User\Address\AddressController::class,'index']);
        Route::post('',[\App\Http\Controllers\User\Address\AddressController::class,'store']);
        Route::post('/{address}',[\App\Http\Controllers\User\Address\AddressController::class,'update']);
        Route::delete('/{address}',[\App\Http\Controllers\User\Address\AddressController::class,'delete']);
    });




});


