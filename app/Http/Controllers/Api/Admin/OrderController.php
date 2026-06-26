<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $perPage = max(1, min(100, request()->integer('per_page', 10)));

        return Order::with(['user', 'items.product'])
            ->latest()
            ->paginate($perPage);
    }

    public function show(Order $order)
    {
        return $order->load(['user', 'items.product']);
    }
}
