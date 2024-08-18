<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

//prefix /order/_
//name order._

Route::controller(OrderController::class)->group(function(){
    Route::get('', 'index')->name('index')->middleware(['throttle:orderlimit']);
    Route::get('/dashboard', 'dashboard')->name('dashboard')->middleware('role:merchant|admin');
    Route::get('/print/{order}', 'print')->name('print');
    Route::put('/{order}', 'update')->name('update');
});