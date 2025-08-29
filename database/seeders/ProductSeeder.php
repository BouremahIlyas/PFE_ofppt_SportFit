<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $sportswear = Category::where('slug', 'sportswear')->first();
        $equipment = Category::where('slug', 'fitness-equipment')->first();
        $accessories = Category::where('slug', 'gym-accessories')->first();

        $products = [
            [
                'category_id' => $sportswear->id ?? null,
                'name' => 'Performance Training T-Shirt',
                'description' => 'Lightweight and breathable t-shirt, perfect for intense workouts. Moisture-wicking fabric keeps you dry and comfortable.',
                'price' => 29.99,
                'stock_quantity' => 150,
                'image_url' => 'https://via.placeholder.com/400x300.png/007bff/ffffff?Text=T-Shirt',
                'is_featured' => true,
                'is_popular' => true, // <-- add this line
            ],
            [
                'category_id' => $sportswear->id ?? null,
                'name' => 'Men\'s Athletic Shorts',
                'description' => 'Comfortable athletic shorts with an elastic waistband and side pockets. Ideal for running, gym, or casual wear.',
                'price' => 34.50,
                'stock_quantity' => 120,
                'image_url' => 'https://via.placeholder.com/400x300.png/28a745/ffffff?Text=Shorts',
                'is_featured' => true,
                'is_popular' => false, // <-- add this line
            ],
            [
                'category_id' => $equipment->id ?? null,
                'name' => 'Adjustable Dumbbell Set',
                'description' => 'Versatile dumbbell set, adjustable from 5 to 52.5 lbs. Perfect for a home gym setup, saving space and providing a wide range of weight options.',
                'price' => 299.99,
                'stock_quantity' => 30,
                'image_url' => 'https://via.placeholder.com/400x300.png/ffc107/000000?Text=Dumbbells',
                'is_featured' => true, // Or omit if default is false
            ],
            [
                'category_id' => $accessories->id ?? null,
                'name' => 'Yoga Mat Premium',
                'description' => 'Extra thick and non-slip yoga mat for comfort and stability during your yoga or pilates sessions. Comes with a carrying strap.',
                'price' => 24.99,
                'stock_quantity' => 200,
                'image_url' => 'https://via.placeholder.com/400x300.png/17a2b8/ffffff?Text=Yoga+Mat',
                'is_featured' => true,
            ],
             [
                'category_id' => $accessories->id ?? null,
                'name' => 'Resistance Bands Set (5 pcs)',
                'description' => 'Set of 5 resistance bands with varying levels of resistance. Great for strength training, physical therapy, and home workouts.',
                'price' => 19.99,
                'stock_quantity' => 300,
                'image_url' => 'https://via.placeholder.com/400x300.png/fd7e14/ffffff?Text=Bands',
                'is_featured' => false,
            ],
        ];

        foreach ($products as $productData) {
            if ($productData['category_id']) {
                Product::firstOrCreate(
                    ['slug' => Str::slug($productData['name'])],
                    [
                        'category_id' => $productData['category_id'],
                        'name' => $productData['name'],
                        'description' => $productData['description'],
                        'price' => $productData['price'],
                        'stock_quantity' => $productData['stock_quantity'],
                        'image_url' => $productData['image_url'],
                        'is_featured' => $productData['is_featured'] ?? false,
                        'is_popular' => $productData['is_popular'] ?? false, // <-- add this line
                    ]
                );
            }
        }
    }
}