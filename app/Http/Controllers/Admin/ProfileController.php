<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Show the form to edit the profile
    public function edit()
    {
        $user = Auth::user(); // Get the currently authenticated user
        return view('admin.profile.edit', compact('user'));
    }

    // Handle the update of the profile
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the input fields
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id, // Ensure email is unique except for current user
            'password' => 'nullable|min:8|confirmed', // Password confirmation required only if changed
        ]);

        // Update the user’s profile information
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Update password only if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('admin.profile.show')->with('success', 'Profile updated successfully!');
    }
    public function show()
    {
        $user = Auth::user(); // Get the authenticated user

        return view('admin.profile.show', compact('user'));
    }

}
