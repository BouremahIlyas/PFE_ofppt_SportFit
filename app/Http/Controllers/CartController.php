<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // Import Session facade

class CartController extends Controller
{
    /**
     * Display the shopping cart.
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    /**
     * Add a product to the cart (typically from product detail page with route model binding).
     */
    public function add(Request $request, Product $product)
    {
        $quantity = $request->input('quantity', 1);

        if ($product->stock_quantity < $quantity) {
            return redirect()->back()->with('error', 'Not enough stock available for ' . $product->name);
        }

        $cart = Session::get('cart', []);

        if (isset($cart[$product->id])) {
            // Product exists in cart, update quantity
            if ($product->stock_quantity < ($cart[$product->id]['quantity'] + $quantity)) {
                 return redirect()->back()->with('error', 'Not enough stock to add more ' . $product->name . ' to cart.');
            }
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            // Product does not exist in cart, add new
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image_url" => $product->image_url,
                "slug" => $product->slug // Store slug for linking back to product
            ];
        }

        Session::put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }

    /**
     * Store a newly added product in the cart (typically from product listing page).
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $product = Product::find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }

        if ($product->stock_quantity < $quantity) {
            return redirect()->back()->with('error', 'Not enough stock available for ' . $product->name);
        }

        $cart = Session::get('cart', []);

        if (isset($cart[$product->id])) {
            // Product exists in cart, update quantity
            if ($product->stock_quantity < ($cart[$product->id]['quantity'] + $quantity)) {
                 return redirect()->back()->with('error', 'Not enough stock to add more ' . $product->name . ' to cart. Current in cart: ' . $cart[$product->id]['quantity']);
            }
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            // Product does not exist in cart, add new
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image_url" => $product->image_url,
                "slug" => $product->slug // Store slug for linking back to product
            ];
        }

        Session::put('cart', $cart);
        // Optionally, redirect to cart page or back with success
        // return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
        return redirect()->back()->with('success', $product->name . ' added to cart!');
    }

    /**
     * Update product quantity in the cart.
     */
    public function update(Request $request, $productId)
    {
        $quantity = $request->input('quantity');
        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            $product = Product::find($productId); // Fetch product to check stock
            if (!$product) {
                return redirect()->route('cart.index')->with('error', 'Product not found.');
            }

            if ($quantity > 0) {
                if ($product->stock_quantity < $quantity) {
                    return redirect()->route('cart.index')->with('error', 'Not enough stock for ' . $cart[$productId]['name'] . '. Max available: ' . $product->stock_quantity);
                }
                $cart[$productId]['quantity'] = $quantity;
            } else {
                // If quantity is 0 or less, remove the item
                unset($cart[$productId]);
            }
            Session::put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
        }
        return redirect()->route('cart.index')->with('error', 'Product not found in cart.');
    }

    /**
     * Remove a product from the cart.
     */
    public function remove($productId)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully!');
        }
        return redirect()->route('cart.index')->with('error', 'Product not found in cart.');
    }

    /**
     * Clear the entire cart.
     */
    public function clear()
    {
        Session::forget('cart');
        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully!');
    }
}
