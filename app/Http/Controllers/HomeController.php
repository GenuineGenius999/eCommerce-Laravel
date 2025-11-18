<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('category')
            ->featured()
            ->active()
            ->inStock()
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::active()
            ->ordered()
            ->take(6)
            ->get();

        $latestProducts = Product::with('category')
            ->active()
            ->inStock()
            ->latest()
            ->take(12)
            ->get();

        $saleProducts = Product::with('category')
            ->active()
            ->inStock()
            ->whereNotNull('sale_price')
            ->where('sale_price', '<', \DB::raw('price'))
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('featuredProducts', 'categories', 'latestProducts', 'saleProducts'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
} 