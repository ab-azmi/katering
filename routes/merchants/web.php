<?php

use App\Http\Controllers\MerchantController;
use Illuminate\Support\Facades\Route;

Route::controller(MerchantController::class)->group(function (){
    Route::get('/{merchant:slug}', 'getMerchant')->name('detail');
    Route::post('/checkout', 'checkout')->name('checkout')->middleware(['auth', 'throttle:orderlimit']);
    Route::patch('/{merchant}', 'update')->name('update');
 });