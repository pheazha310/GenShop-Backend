<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin User', 'password' => Hash::make('password'), 'is_admin' => true]
        );

        $categories = collect(['Phones', 'Laptops', 'Accessories'])->map(function ($name) {
            return Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'is_active' => true]
            );
        });

        Product::firstOrCreate(
            ['slug' => 'sample-product'],
            [
                'category_id' => $categories->first()->id,
                'name' => 'Sample Product',
                'description' => 'Starter product for the ecommerce system.',
                'price' => 99.99,
                'stock' => 25,
                'image' => null,
                'is_active' => true,
            ]
        );

        $products = [
            [
                'slug' => 'nexus-core-v2-smartwatch',
                'category_id' => $categories[0]->id,
                'name' => 'Nexus Core v2 Smartwatch',
                'description' => 'A clean smartwatch with all-day battery life and health tracking.',
                'price' => 249.00,
                'stock' => 18,
                'image' => 'https://picsum.photos/seed/nexus-core-watch/900/900',
            ],
            [
                'slug' => 'executive-leather-briefcase',
                'category_id' => $categories[2]->id,
                'name' => 'Executive Leather Briefcase',
                'description' => 'A structured briefcase with polished hardware and premium finish.',
                'price' => 185.50,
                'stock' => 12,
                'image' => 'https://picsum.photos/seed/executive-briefcase/900/900',
            ],
            [
                'slug' => 'nexus-audio-anc-pro',
                'category_id' => $categories[2]->id,
                'name' => 'Nexus Audio ANC Pro',
                'description' => 'Adaptive noise cancelling headphones tuned for focus and travel.',
                'price' => 320.00,
                'stock' => 9,
                'image' => 'https://picsum.photos/seed/nexus-anc-headphones/900/900',
            ],
            [
                'slug' => 'geometric-ceramic-vase',
                'category_id' => $categories[2]->id,
                'name' => 'Geometric Ceramic Vase',
                'description' => 'Minimal home decor with warm shadows and soft matte texture.',
                'price' => 45.00,
                'stock' => 30,
                'image' => 'https://picsum.photos/seed/geometric-vase/900/900',
            ],
            [
                'slug' => 'vantage-laptop-pro',
                'category_id' => $categories[1]->id,
                'name' => 'Vantage Laptop Pro',
                'description' => 'A slim laptop built for creative workflows and portable productivity.',
                'price' => 1299.00,
                'stock' => 7,
                'image' => 'https://picsum.photos/seed/vantage-laptop/900/900',
            ],
            [
                'slug' => 'aero-buds-elite',
                'category_id' => $categories[0]->id,
                'name' => 'Aero Buds Elite',
                'description' => 'Compact earbuds with crisp sound and seamless connectivity.',
                'price' => 129.00,
                'stock' => 22,
                'image' => 'https://picsum.photos/seed/aero-buds/900/900',
            ],
        ];

        foreach ($products as $productData) {
            Product::firstOrCreate(
                ['slug' => $productData['slug']],
                array_merge($productData, ['is_active' => true])
            );
        }

        $sampleUsers = collect([
            ['name' => 'Jane Doe', 'email' => 'jane@example.com'],
            ['name' => 'Marcus Sterling', 'email' => 'marcus@example.com'],
            ['name' => 'Alisa Hoffman', 'email' => 'alisa@example.com'],
            ['name' => 'Robert Wright', 'email' => 'robert@example.com'],
            ['name' => 'Elena Lopez', 'email' => 'elena@example.com'],
        ])->map(function (array $user) {
            return User::firstOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make('password'),
                    'is_admin' => false,
                ]
            );
        });

        $sampleProducts = Product::whereIn('slug', [
            'sample-product',
            'nexus-core-v2-smartwatch',
            'executive-leather-briefcase',
            'nexus-audio-anc-pro',
            'geometric-ceramic-vase',
            'vantage-laptop-pro',
            'aero-buds-elite',
        ])->get()->keyBy('slug');

        $sampleOrders = [
            [
                'user' => $sampleUsers[0],
                'code' => 'ORD-8921',
                'total' => 245.00,
                'status' => 'completed',
                'created_at' => now()->copy()->startOfMonth()->subMonths(5)->setDay(14)->setTime(10, 0),
                'product_slug' => 'sample-product',
            ],
            [
                'user' => $sampleUsers[1],
                'code' => 'ORD-8920',
                'total' => 1120.50,
                'status' => 'pending',
                'created_at' => now()->copy()->startOfMonth()->subMonths(3)->setDay(18)->setTime(13, 30),
                'product_slug' => 'vantage-laptop-pro',
            ],
            [
                'user' => $sampleUsers[2],
                'code' => 'ORD-8919',
                'total' => 84.99,
                'status' => 'completed',
                'created_at' => now()->copy()->startOfMonth()->subMonths(2)->setDay(9)->setTime(9, 15),
                'product_slug' => 'aero-buds-elite',
            ],
            [
                'user' => $sampleUsers[3],
                'code' => 'ORD-8918',
                'total' => 422.00,
                'status' => 'cancelled',
                'created_at' => now()->copy()->startOfMonth()->subMonth()->setDay(21)->setTime(16, 45),
                'product_slug' => 'executive-leather-briefcase',
            ],
            [
                'user' => $sampleUsers[4],
                'code' => 'ORD-8917',
                'total' => 2300.00,
                'status' => 'processing',
                'created_at' => now()->copy()->setDay(6)->setTime(11, 5),
                'product_slug' => 'vantage-laptop-pro',
            ],
        ];

        foreach ($sampleOrders as $orderData) {
            $order = Order::updateOrCreate(
                ['shipping_phone' => '555-' . $orderData['code']],
                [
                    'user_id' => $orderData['user']->id,
                    'total_amount' => $orderData['total'],
                    'status' => $orderData['status'],
                    'shipping_name' => $orderData['user']->name,
                    'shipping_phone' => '555-' . $orderData['code'],
                    'shipping_address' => 'Sample address for ' . $orderData['user']->name,
                    'notes' => 'Seeded dashboard order',
                ]
            );

            $order->forceFill([
                'created_at' => $orderData['created_at'],
                'updated_at' => $orderData['created_at'],
            ])->save();

            OrderItem::updateOrCreate(
                ['order_id' => $order->id],
                [
                    'product_id' => $sampleProducts[$orderData['product_slug']]->id,
                    'quantity' => 1,
                    'price' => $orderData['total'],
                ]
            );
        }
    }
}
