<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        $products = [
            // Electronics
            [
                'name' => 'Premium Wireless Headphones',
                'slug' => 'premium-wireless-headphones',
                'description' => 'High-quality wireless headphones with noise cancellation and premium sound quality. Perfect for music lovers and professionals.',
                'short_description' => 'Premium wireless headphones with noise cancellation',
                'price' => 299.99,
                'sale_price' => 249.99,
                'stock_quantity' => 50,
                'sku' => 'ELEC-001',
                'is_featured' => true,
                'category_id' => $categories->where('slug', 'electronics')->first()->id,
                'specifications' => [
                    'Bluetooth' => '5.0',
                    'Battery Life' => '30 hours',
                    'Noise Cancellation' => 'Active',
                    'Weight' => '250g'
                ],
                'tags' => ['wireless', 'noise-cancellation', 'premium', 'bluetooth'],
                'rating' => 4.8,
                'review_count' => 156,
            ],
            [
                'name' => 'Smart Fitness Watch',
                'slug' => 'smart-fitness-watch',
                'description' => 'Advanced fitness tracking with heart rate monitoring, GPS, and smartphone connectivity. Track your workouts and stay connected.',
                'short_description' => 'Advanced fitness tracking with heart rate monitoring',
                'price' => 199.99,
                'stock_quantity' => 75,
                'sku' => 'ELEC-002',
                'is_featured' => true,
                'category_id' => $categories->where('slug', 'electronics')->first()->id,
                'specifications' => [
                    'Display' => '1.4" AMOLED',
                    'Battery Life' => '7 days',
                    'Water Resistance' => '5ATM',
                    'GPS' => 'Built-in'
                ],
                'tags' => ['fitness', 'smartwatch', 'health', 'tracking'],
                'rating' => 4.6,
                'review_count' => 89,
            ],
            [
                'name' => 'Ultra HD Camera',
                'slug' => 'ultra-hd-camera',
                'description' => 'Professional 4K camera with advanced autofocus and image stabilization. Perfect for content creators and photographers.',
                'short_description' => 'Professional 4K camera with advanced features',
                'price' => 899.99,
                'sale_price' => 749.99,
                'stock_quantity' => 25,
                'sku' => 'ELEC-003',
                'is_featured' => true,
                'category_id' => $categories->where('slug', 'electronics')->first()->id,
                'specifications' => [
                    'Resolution' => '4K',
                    'Sensor' => '1-inch CMOS',
                    'Zoom' => '20x Optical',
                    'Stabilization' => '5-axis'
                ],
                'tags' => ['camera', '4k', 'professional', 'photography'],
                'rating' => 4.9,
                'review_count' => 234,
            ],

            // Fashion
            [
                'name' => 'Designer Leather Jacket',
                'slug' => 'designer-leather-jacket',
                'description' => 'Premium leather jacket with modern design and comfortable fit. Perfect for any occasion.',
                'short_description' => 'Premium leather jacket with modern design',
                'price' => 399.99,
                'stock_quantity' => 30,
                'sku' => 'FASH-001',
                'category_id' => $categories->where('slug', 'fashion')->first()->id,
                'specifications' => [
                    'Material' => 'Genuine Leather',
                    'Lining' => 'Polyester',
                    'Closure' => 'Zipper',
                    'Care' => 'Dry Clean Only'
                ],
                'tags' => ['leather', 'jacket', 'premium', 'designer'],
                'rating' => 4.7,
                'review_count' => 67,
            ],
            [
                'name' => 'Comfortable Running Shoes',
                'slug' => 'comfortable-running-shoes',
                'description' => 'Lightweight running shoes with superior cushioning and breathable mesh upper. Perfect for daily runs.',
                'short_description' => 'Lightweight running shoes with superior cushioning',
                'price' => 129.99,
                'sale_price' => 99.99,
                'stock_quantity' => 100,
                'sku' => 'FASH-002',
                'category_id' => $categories->where('slug', 'fashion')->first()->id,
                'specifications' => [
                    'Upper' => 'Mesh',
                    'Sole' => 'Rubber',
                    'Weight' => '280g',
                    'Drop' => '8mm'
                ],
                'tags' => ['running', 'shoes', 'comfortable', 'lightweight'],
                'rating' => 4.5,
                'review_count' => 189,
            ],

            // Home & Garden
            [
                'name' => 'Smart LED Light Bulbs',
                'slug' => 'smart-led-light-bulbs',
                'description' => 'WiFi-enabled LED bulbs with millions of colors and voice control. Transform your home lighting.',
                'short_description' => 'WiFi-enabled LED bulbs with voice control',
                'price' => 79.99,
                'stock_quantity' => 200,
                'sku' => 'HOME-001',
                'is_featured' => true,
                'category_id' => $categories->where('slug', 'home-garden')->first()->id,
                'specifications' => [
                    'Wattage' => '9W',
                    'Lumens' => '800',
                    'Color Temperature' => '2700K-6500K',
                    'Lifespan' => '25,000 hours'
                ],
                'tags' => ['smart', 'led', 'lighting', 'wifi'],
                'rating' => 4.4,
                'review_count' => 312,
            ],
            [
                'name' => 'Garden Tool Set',
                'slug' => 'garden-tool-set',
                'description' => 'Complete garden tool set with ergonomic handles and rust-resistant coating. Everything you need for gardening.',
                'short_description' => 'Complete garden tool set with ergonomic handles',
                'price' => 149.99,
                'stock_quantity' => 45,
                'sku' => 'HOME-002',
                'category_id' => $categories->where('slug', 'home-garden')->first()->id,
                'specifications' => [
                    'Material' => 'Stainless Steel',
                    'Handles' => 'Ergonomic',
                    'Coating' => 'Rust-resistant',
                    'Pieces' => '12'
                ],
                'tags' => ['garden', 'tools', 'ergonomic', 'rust-resistant'],
                'rating' => 4.6,
                'review_count' => 78,
            ],

            // Sports & Outdoors
            [
                'name' => 'Professional Yoga Mat',
                'slug' => 'professional-yoga-mat',
                'description' => 'Premium yoga mat with excellent grip and cushioning. Perfect for yoga, pilates, and meditation.',
                'short_description' => 'Premium yoga mat with excellent grip',
                'price' => 89.99,
                'stock_quantity' => 80,
                'sku' => 'SPORT-001',
                'category_id' => $categories->where('slug', 'sports-outdoors')->first()->id,
                'specifications' => [
                    'Thickness' => '6mm',
                    'Material' => 'TPE',
                    'Size' => '183x61cm',
                    'Weight' => '2.5kg'
                ],
                'tags' => ['yoga', 'mat', 'fitness', 'meditation'],
                'rating' => 4.8,
                'review_count' => 145,
            ],
            [
                'name' => 'Portable Bluetooth Speaker',
                'slug' => 'portable-bluetooth-speaker',
                'description' => 'Waterproof portable speaker with 360-degree sound and 20-hour battery life. Perfect for outdoor activities.',
                'short_description' => 'Waterproof portable speaker with 360-degree sound',
                'price' => 159.99,
                'sale_price' => 129.99,
                'stock_quantity' => 60,
                'sku' => 'SPORT-002',
                'is_featured' => true,
                'category_id' => $categories->where('slug', 'sports-outdoors')->first()->id,
                'specifications' => [
                    'Output' => '20W',
                    'Battery' => '20 hours',
                    'Waterproof' => 'IPX7',
                    'Connectivity' => 'Bluetooth 5.0'
                ],
                'tags' => ['speaker', 'portable', 'waterproof', 'bluetooth'],
                'rating' => 4.7,
                'review_count' => 203,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
} 