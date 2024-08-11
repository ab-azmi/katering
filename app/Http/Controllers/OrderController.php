<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    private $orders;

    public function __construct()
    {
        if (auth()->user()) {
            $id = auth()->id();
            $this->orders = Order::with('orderItems.menu', 'merchant', 'customer')
                ->where('customer_id', $id)
                ->orWhere('merchant_id', $id)
                ->latest()
                ->get();
        }
    }
    public function index()
    {
        return Inertia::render('Orders/Index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'orders' => $this->orders,
            'isCustomer' => auth()->user()?->isCustomer,
        ]);
    }

    public function dashboard()
    {
        return Inertia::render('Orders/Dashboard', [
            'orders' => $this->orders,
            'isCustomer' => auth()->user()?->isCustomer,
        ]);
    }

    public function print(Order $order)
    {
        $order->load('orderItems.menu', 'merchant.merchant', 'customer.customer');
        // dd($order->toArray());
        $pdf = Pdf::loadView('pdf.invoice', $order->toArray());
        return $pdf->download($order->code . '.pdf');
    }

    public function update(Order $order, Request $request)
    {   
        $request->validate([
            'status' => 'required|string',
            'code' => 'required|string',
            'total' => 'required|numeric',
            'note' => 'nullable|string',
        ]);
        $order->update($request->all());
        return back();
    }
}
