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
                'name' => 'Electronics',
                'slug' => 'electronics',
                'description' => 'Latest gadgets and electronic devices',
                'icon' => 'fas fa-mobile-alt',
                'sort_order' => 1,
            ],
            [
                'name' => 'Fashion',
                'slug' => 'fashion',
                'description' => 'Trendy clothing and accessories',
                'icon' => 'fas fa-tshirt',
                'sort_order' => 2,
            ],
            [
                'name' => 'Home & Garden',
                'slug' => 'home-garden',
                'description' => 'Everything for your home and garden',
                'icon' => 'fas fa-home',
                'sort_order' => 3,
            ],
            [
                'name' => 'Sports & Outdoors',
                'slug' => 'sports-outdoors',
                'description' => 'Equipment and gear for active lifestyle',
                'icon' => 'fas fa-dumbbell',
                'sort_order' => 4,
            ],
            [
                'name' => 'Books & Media',
                'slug' => 'books-media',
                'description' => 'Books, movies, and entertainment',
                'icon' => 'fas fa-book',
                'sort_order' => 5,
            ],
            [
                'name' => 'Health & Beauty',
                'slug' => 'health-beauty',
                'description' => 'Personal care and wellness products',
                'icon' => 'fas fa-heart',
                'sort_order' => 6,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
} 