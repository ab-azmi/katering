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
})->middleware(['auth', 'verified', 'role:admin|merchant'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(MerchantController::class)->group(function (){
   Route::get('/merchant/{merchant}', 'getMerchant')->name('merchant.detail');
   Route::post('/checkout', 'checkout')->name('checkout');
   Route::patch('/merchant/{merchant}', 'update')->name('merchant.update');
});

Route::controller(OrderController::class)->group(function(){
    Route::get('/order', 'index')->name('order.index')->middleware('role:customer');
    Route::get('/order/dashboard', 'dashboard')->name('dashboard.order')->middleware('role:merchant');
    Route::get('/order/print/{order}', 'print')->name('order.print');
    Route::put('/order/{order}', 'update')->name('order.update');
});

require __DIR__.'/auth.php';
