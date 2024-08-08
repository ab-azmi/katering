<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(MerchantController::class)->group(function (){
   Route::get('/merchant/{merchant}', 'getMerchant')->name('merchant.detail');
   Route::post('/checkout', 'checkout')->name('checkout');
});

Route::controller(OrderController::class)->group(function(){
    Route::get('/order', 'index')->name('order.index');
    Route::get('/order/print/{order}', 'print')->name('order.print');
    Route::post('/order/status/{order}/{status}', 'status')->name('order.status');
});

require __DIR__.'/auth.php';
