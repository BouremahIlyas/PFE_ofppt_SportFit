<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class WishlistController extends Controller
{
    public function store(Request $request, $productId)
    {
        $user = auth()->user();
        $user->wishlist()->syncWithoutDetaching([$productId]);
        return back()->with('success', 'Added to wishlist!');
    }

    public function destroy(Request $request, $productId)
    {
        $user = auth()->user();
        $user->wishlist()->detach($productId);
        return back()->with('success', 'Removed from wishlist!');
    }

    public function index()
    {
        $wishlistProducts = auth()->user()->wishlist()->with('category')->get();
        return view('wishlist.index', compact('wishlistProducts'));
    }
}