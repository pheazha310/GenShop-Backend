<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::query()
            ->where('is_active', true)
            ->withCount('products')
            ->orderBy('name')
            ->get();
    }

    public function show(Category $category)
    {
        return $category->load(['products' => function ($query) {
            $query->with(['category', 'images'])
                ->withCount('reviews')
                ->withAvg('reviews', 'rating')
                ->where('is_active', true)
                ->latest();
        }])->loadCount('products');
    }
}
