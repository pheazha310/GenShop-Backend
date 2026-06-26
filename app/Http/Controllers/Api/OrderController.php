<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $data = $request->validate([
            'shipping_name' => ['required', 'string', 'max:255'],
            'shipping_phone' => ['required', 'string', 'max:50'],
            'shipping_address' => ['required', 'string', 'max:500'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $userId = $request->user()->id;
        $cartItems = CartItem::with('product')->where('user_id', $userId)->get();

        abort_if($cartItems->isEmpty(), 422, 'Cart is empty');

        $order = DB::transaction(function () use ($cartItems, $data, $userId) {
            $total = $cartItems->sum(fn ($item) => $item->quantity * $item->product->price);

            $order = Order::create([
                'user_id' => $userId,
                'total_amount' => $total,
                'status' => 'pending',
                'shipping_name' => $data['shipping_name'],
                'shipping_phone' => $data['shipping_phone'],
                'shipping_address' => $data['shipping_address'],
                'notes' => $data['notes'] ?? null,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            CartItem::where('user_id', $userId)->delete();

            return $order;
        });

        return response()->json($order->load('items.product'), 201);
    }

    public function index(Request $request)
    {
        return Order::with('items.product')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();
    }

    public function show(Request $request, Order $order)
    {
        abort_unless($order->user_id === $request->user()->id, 403);

        return $order->load('items.product');
    }
}
