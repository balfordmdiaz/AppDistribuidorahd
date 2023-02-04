<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function store(Request $request)
    {
        // Retrieve the CSRF token from the current user session
        $token = csrf_token();

        // Retrieve the token sent in the form data
        $receivedToken = $request->input('_token');

        // Compare the tokens to ensure they match
        if ($token !== $receivedToken) {
            return response()->json(['error' => 'CSRF token mismatch'], 419);
        }

        // Continue with the form submission logic
        // ...

        // Return a success response or redirect to another page
        return redirect()->route('/home');
    }
}
