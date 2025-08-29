<?php

namespace App\Http\Controllers;

use App\Models\Product; // Assuming you already use this for featured products
use App\Models\Category; // Add this line to import the Category model
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index(): View
    {
        // Example: if your column is named 'highlighted'
        // $featuredProducts = Product::where('highlighted', true) 
        $featuredProducts = Product::where('is_featured', true) 
                                   ->orderBy('created_at', 'desc')
                                   ->take(3)
                                   ->get();

        // Fetch popular products (e.g., where is_popular = true, or by sales, etc.)
        $popularProducts = Product::where('is_popular', true)
                                  ->orderBy('created_at', 'desc')
                                  ->take(3)
                                  ->get();

        // Fetch categories
        $categories = Category::orderBy('name', 'asc')->take(4)->get(); // Fetch top 4 categories, or all

        return view('home', compact('featuredProducts', 'categories', 'popularProducts'));
    }
}
