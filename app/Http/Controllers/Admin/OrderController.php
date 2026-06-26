<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.orders.index', [
            'orders' => Order::with('user')->latest()->get(),
        ]);
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', [
            'order' => $order->load('user', 'items.product'),
        ]);
    }
}
