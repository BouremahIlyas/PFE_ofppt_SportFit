<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Sportswear',
                'description' => 'Apparel for various sports activities.',
                'image_url' => 'images/categories/sportswear.jpg'
            ],
            [
                'name' => 'Fitness Equipment',
                'description' => 'Gear and machines for workouts.',
                'image_url' => 'images/categories/fitness-equipment.jpg'
            ],
            [
                'name' => 'Gym Accessories',
                'description' => 'Accessories to enhance your gym experience.',
                'image_url' => 'images/categories/gym-accessories.jpg'
            ],
            [
                'name' => 'Footwear',
                'description' => 'Athletic shoes for training and sports.',
                'image_url' => 'images/categories/footwear.jpg'
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::firstOrCreate(
                ['slug' => Str::slug($categoryData['name'])], // Attributes to find the record
                [
                    'name' => $categoryData['name'],
                    'description' => $categoryData['description'],
                    'image_url' => $categoryData['image_url'], // <-- Add this line
                ]
            );
        }
    }
}