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

        $categories = collect(['Men', 'Women', 'Kids', 'Shoes', 'Accessories'])->map(function ($name) {
            return Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'is_active' => true]
            );
        });

        Product::firstOrCreate(
            ['slug' => 'classic-fit-cotton-tshirt'],
            [
                'category_id' => $categories->first()->id,
                'name' => 'Classic Fit Cotton T-Shirt',
                'description' => 'A soft, breathable cotton tee in a relaxed fit for everyday wear.',
                'price' => 29.99,
                'stock' => 120,
                'image' => 'https://picsum.photos/seed/cotton-tshirt/900/900',
                'is_active' => true,
            ]
        );

        $products = [
            [
                'slug' => 'slim-fit-chinos',
                'category_id' => $categories[0]->id,
                'name' => 'Slim Fit Chinos',
                'description' => 'Tailored stretch-chino pants with a sharp taper and all-day comfort.',
                'price' => 59.99,
                'stock' => 45,
                'image' => 'https://picsum.photos/seed/slim-chinos/900/900',
            ],
            [
                'slug' => 'leather-belts',
                'category_id' => $categories[4]->id,
                'name' => 'Leather Belts',
                'description' => 'Full-grain leather belts with a polished buckle for work and casual looks.',
                'price' => 34.50,
                'stock' => 80,
                'image' => 'https://picsum.photos/seed/leather-belts/900/900',
            ],
            [
                'slug' => 'aviator-sunglasses',
                'category_id' => $categories[4]->id,
                'name' => 'Classic Aviator Sunglasses',
                'description' => 'UV-protected metal-frame sunglasses with a timeless aviator shape.',
                'price' => 49.00,
                'stock' => 60,
                'image' => 'https://picsum.photos/seed/aviator-sunglasses/900/900',
            ],
            [
                'slug' => 'canvas-sneakers',
                'category_id' => $categories[3]->id,
                'name' => 'Canvas Sneakers',
                'description' => 'Low-top canvas sneakers with cushioned insoles and a clean court look.',
                'price' => 54.00,
                'stock' => 35,
                'image' => 'https://picsum.photos/seed/canvas-sneakers/900/900',
            ],
            [
                'slug' => 'wool-sweater',
                'category_id' => $categories[1]->id,
                'name' => 'Premium Wool Sweater',
                'description' => 'Cozy merino-wool blend sweater with a relaxed fit and ribbed cuffs.',
                'price' => 89.00,
                'stock' => 28,
                'image' => 'https://picsum.photos/seed/wool-sweater/900/900',
            ],
            [
                'slug' => 'denim-jacket',
                'category_id' => $categories[2]->id,
                'name' => 'Kids Denim Jacket',
                'description' => 'Durable denim jacket with a soft interior lining and adjustable cuffs.',
                'price' => 44.99,
                'stock' => 40,
                'image' => 'https://picsum.photos/seed/denim-jacket/900/900',
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
            'classic-fit-cotton-tshirt',
            'slim-fit-chinos',
            'leather-belts',
            'aviator-sunglasses',
            'canvas-sneakers',
            'wool-sweater',
            'denim-jacket',
        ])->get()->keyBy('slug');

        $sampleOrders = [
            [
                'user' => $sampleUsers[0],
                'code' => 'ORD-8921',
                'total' => 59.99,
                'status' => 'completed',
                'created_at' => now()->copy()->startOfMonth()->subMonths(5)->setDay(14)->setTime(10, 0),
                'product_slug' => 'slim-fit-chinos',
            ],
            [
                'user' => $sampleUsers[1],
                'code' => 'ORD-8920',
                'total' => 89.00,
                'status' => 'pending',
                'created_at' => now()->copy()->startOfMonth()->subMonths(3)->setDay(18)->setTime(13, 30),
                'product_slug' => 'wool-sweater',
            ],
            [
                'user' => $sampleUsers[2],
                'code' => 'ORD-8919',
                'total' => 54.00,
                'status' => 'completed',
                'created_at' => now()->copy()->startOfMonth()->subMonths(2)->setDay(9)->setTime(9, 15),
                'product_slug' => 'canvas-sneakers',
            ],
            [
                'user' => $sampleUsers[3],
                'code' => 'ORD-8918',
                'total' => 34.50,
                'status' => 'cancelled',
                'created_at' => now()->copy()->startOfMonth()->subMonth()->setDay(21)->setTime(16, 45),
                'product_slug' => 'leather-belts',
            ],
            [
                'user' => $sampleUsers[4],
                'code' => 'ORD-8917',
                'total' => 29.99,
                'status' => 'processing',
                'created_at' => now()->copy()->setDay(6)->setTime(11, 5),
                'product_slug' => 'classic-fit-cotton-tshirt',
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
