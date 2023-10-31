<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function updateProfile(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        } 
        $user = Auth::user();

        // Validate the incoming request data
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            // Add more fields to validate as needed
        ]);

        // Update the user's profile
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            // Update other fields as needed
        ]);

        return response()->json(['message' => 'Profile updated successfully']);
    }


    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        // Delete the user's account
        $user->delete();

        return response()->json(['message' => 'Account deleted successfully']);
    }
}
