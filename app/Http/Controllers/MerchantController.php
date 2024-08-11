<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MerchantController extends Controller
{
    public function getMerchant(Merchant $merchant)
    {
        $merchant->load('menus', 'user');
        return Inertia::render('Merchant/DetailMerchant', [
            'merchant' => $merchant
        ]);
    }

    public function Checkout(Request $request)
    {
        try {
            $request->validate([
                'merchant_id' => 'required|exists:users,id',
                'total' => 'required|numeric',
                'items' => 'required|array',
                'items.*.menu.id' => 'required|exists:menus,id',
                'items.*.quantity' => 'required|numeric'
            ]);

            //create order
            $order = Order::create([
                'merchant_id' => $request->merchant_id, //user_id
                'customer_id' => auth()->id(),
                'code' => 'ORD-' . time(),
                'total' => $request->total,
                'send_at' => now()
            ]);
            //create order items
            foreach ($request->items as $item) {
                $order->orderItems()->create([
                    'menu_id' => $item['menu']['id'],
                    'quantity' => $item['quantity'],
                ]);
            }

            return;
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Merchant $merchant, Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
        ]);

        $merchant->update($request->all());

        return redirect()->back();
    }
}
