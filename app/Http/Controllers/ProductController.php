<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; // Import the Category model
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index(Request $request): View // Add Request $request
    {
        $query = Product::query(); // Start building the query
        $categories = Category::orderBy('name')->get(); // Fetch categories for the dropdown

        // Filter by category
        if ($request->filled('category')) {
            $categorySlug = $request->input('category');
            // Ensure the relationship name 'category' matches your Product model
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        // Sort products
        $sortOption = $request->input('sort', 'latest'); // Default to 'latest'

        switch ($sortOption) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            // Add other sorting options if needed, e.g., by name
            // case 'name_asc':
            //     $query->orderBy('name', 'asc');
            //     break;
            // case 'name_desc':
            //     $query->orderBy('name', 'desc');
            //     break;
            case 'latest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate(12); // Paginate the results

        // Append query strings to pagination links so filters/sort are maintained
        $products->appends($request->query());

        return view('products.index', compact('products', 'categories')); // Pass categories to the view
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product): View // Using route model binding
    {
        // The $product variable is automatically resolved by Laravel
        // based on the slug or ID in the route.
        // Ensure your Product model has a getRouteKeyName() method returning 'slug' if using slugs.
        return view('products.show', compact('product'));
    }

    /**
     * Show the admin manage products page.
     */
    public function manage()
    {
        $products = Product::with('category')->paginate(15);
        return view('admin.products.manage', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'slug' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'image_url' => 'nullable|string|max:255',
            // Remove boolean validation for checkboxes
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_popular'] = $request->has('is_popular');

        Product::create($validated);

        return redirect()->route('admin.products.manage')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product): View
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'slug' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'image_url' => 'nullable|string|max:255',
            // Remove boolean validation for checkboxes
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_popular'] = $request->has('is_popular');

        $product->update($validated);

        return redirect()->route('admin.products.manage')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('admin.products.manage')->with('success', 'Product deleted successfully.');
    }
}