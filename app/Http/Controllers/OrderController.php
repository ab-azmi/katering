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
        if(auth()->user()->hasRole('customer')){
            $id = auth()->user()->customer->id ?? null;
            $orders = Order::with('orderItems.menu', 'merchant', 'customer')
                ->where('customer_id', $id)
                ->latest()
                ->get();
        }else{
            $id = auth()->user()->merchant->id ?? null;
            $orders = Order::with('orderItems.menu', 'merchant', 'customer')
                ->where('merchant_id', $id)
                ->latest()
                ->get();
        }


        return Inertia::render('Orders/Index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'orders' => $orders,
            'isCustomer' => auth()->user()?->isCustomer,
        ]);
    }

    public function print(Order $order)
    {
        $order->load('orderItems.menu', 'merchant', 'customer');
        $pdf = Pdf::loadView('pdf.invoice', $order->toArray());
        return $pdf->download($order->code.'.pdf');
    }

    public function status(Order $order, $status)
    {
    }
}
