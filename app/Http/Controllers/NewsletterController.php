<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Potentially use a Model for storing subscribers, e.g., use App\Models\Subscriber;
use Illuminate\Support\Facades\Validator; // For validation
use Illuminate\Support\Facades\Log; // For logging

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscribers,email', // Assuming you have a 'subscribers' table
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
            // Or return a JSON response if it's an AJAX request
            // return response()->json(['errors' => $validator->errors()], 422);
        }

        // Store the email (e.g., in a database)
        // Subscriber::create(['email' => $request->email]);
        // For now, let's just log it
        Log::info('New newsletter subscription: ' . $request->email);


        // Redirect back with a success message
        return back()->with('success', 'Thank you for subscribing to our newsletter!');
        // Or return a JSON response
        // return response()->json(['message' => 'Thank you for subscribing!']);
    }
}
