<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\WishlistItem;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        return WishlistItem::with('product.category')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $item = WishlistItem::firstOrCreate([
            'user_id' => $request->user()->id,
            'product_id' => $data['product_id'],
        ]);

        return response()->json($item->load('product'), 201);
    }

    public function destroy(Request $request, Product $product)
    {
        WishlistItem::where('user_id', $request->user()->id)
            ->where('product_id', $product->id)
            ->delete();

        return response()->json(['message' => 'Removed']);
    }
}
