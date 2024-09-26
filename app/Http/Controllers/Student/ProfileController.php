<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Show the form to edit the profile
    public function edit()
    {
        $user = Auth::user(); // Get the currently authenticated student
        return view('student.profile.edit', compact('user'));
    }

    // Update the profile
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id, // Ensure unique email, but allow the current user to keep their own email
            'password' => 'nullable|min:8|confirmed', // Password is optional but should be confirmed if entered
        ]);

        // Update the profile details
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Update password only if a new one is provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save(); // Save the updated profile

        return redirect()->route('student.profile.show')->with('success', 'Profile updated successfully!');
    }
        public function show()
    {
        $user = Auth::user(); // Get the currently authenticated user
        return view('student.profile.show', compact('user'));
    }

}

