<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        return CartItem::with('product.category')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        $product = \App\Models\Product::findOrFail($data['product_id']);

        $item = CartItem::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'product_id' => $data['product_id'],
            ],
            [
                'quantity' => $data['quantity'] ?? 1,
                'price' => $product->price,
            ]
        );

        return response()->json($item->load('product'), 201);
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $this->authorizeCartItem($request, $cartItem);

        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cartItem->update($data);

        return $cartItem->load('product');
    }

    public function destroy(Request $request, CartItem $cartItem)
    {
        $this->authorizeCartItem($request, $cartItem);
        $cartItem->delete();

        return response()->json(['message' => 'Removed']);
    }

    public function clear(Request $request)
    {
        CartItem::where('user_id', $request->user()->id)->delete();

        return response()->json(['message' => 'Cart cleared']);
    }

    private function authorizeCartItem(Request $request, CartItem $cartItem): void
    {
        abort_unless($cartItem->user_id === $request->user()->id, 403);
    }
}
