<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact-us');
    }

    public function submit(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // Process the data (e.g., send email, save to DB)
        // For example:
        // Mail::to('your-email@example.com')->send(new ContactFormMail($validatedData));

        return redirect()->route('contact.us')->with('success', 'Your message has been sent successfully!'); // Changed 'contact.show' to 'contact.us'
    }
}