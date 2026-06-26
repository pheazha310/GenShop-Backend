<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSales = (float) Order::whereIn('status', ['completed', 'processing'])->sum('total_amount');
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCustomers = User::count();
        $totalCategories = Category::count();

        $monthlySales = Order::query()
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_amount) as total')
            )
            ->whereIn('status', ['completed', 'processing'])
            ->where('created_at', '>=', now()->subYear())
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $thisYearSales = array_fill(1, 12, 0);
        $lastYearSales = array_fill(1, 12, 0);

        foreach ($monthlySales as $sale) {
            if ((int) $sale->year === now()->year) {
                $thisYearSales[(int) $sale->month] = (float) $sale->total;
            }

            if ((int) $sale->year === now()->subYear()->year) {
                $lastYearSales[(int) $sale->month] = (float) $sale->total;
            }
        }

        $topCategories = Category::query()
            ->select('categories.id', 'categories.name', DB::raw('COUNT(products.id) as product_count'))
            ->leftJoin('products', 'products.category_id', '=', 'categories.id')
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('product_count')
            ->limit(5)
            ->get();

        $categoryTotal = $topCategories->sum('product_count') ?: 1;

        $recentOrders = Order::query()
            ->with('user')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        $orderStatusCounts = Order::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status')
            ->all();

        return view('admin.dashboard', [
            'totalSales' => $totalSales,
            'totalOrders' => $totalOrders,
            'totalProducts' => $totalProducts,
            'totalCustomers' => $totalCustomers,
            'totalCategories' => $totalCategories,
            'thisYearSales' => $thisYearSales,
            'lastYearSales' => $lastYearSales,
            'topCategories' => $topCategories,
            'categoryTotal' => $categoryTotal,
            'recentOrders' => $recentOrders,
            'orderStatusCounts' => $orderStatusCounts,
        ]);
    }
}
