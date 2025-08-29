<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     */
    public function index(): View
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('info', 'Your cart is empty. Please add products before proceeding to checkout.');
        }

        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        // You would typically pass cart data and total to a checkout view
        // For now, let's assume you have a 'checkout.index' view
        return view('checkout.index', compact('cart', 'total'));
    }

    public function process(Request $request)
    {
        // Validate the request data (customize rules as needed)
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'country' => 'required|string|max:255',
            'card_number' => 'nullable|string|max:20', 
        ]);

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('info', 'Your cart is empty. Cannot proceed to checkout.');
        }

        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        // --- Create the Order in the database ---
        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'status' => 'pending',
            // Add more fields if your Order model/migration supports them
        ]);

        // Optionally: Save order items in a separate table (not shown here)

        // Clear the cart from the session
        Session::forget('cart');

        // Redirect to a success page (e.g., home or an order confirmation page)
        return redirect()->route('home')->with('success', 'Your order has been placed successfully!');
    }
}