<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::with('orderItems', 'merchant', 'customer')->get();

        return Inertia::render('Orders/Index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'orders' => $orders,
        ]);
    }
}
