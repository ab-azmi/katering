<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems', 'merchant', 'customer')->get();
        return Inertia::render('Orders/Index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'orders' => $orders,
        ]);
    }

    public function print(Order $order)
    {
        $order->load('orderItems.menu', 'merchant', 'customer');
        $pdf = Pdf::loadView('pdf.invoice', $order->toArray());
        return $pdf->download($order->code.'.pdf');
    }
}
