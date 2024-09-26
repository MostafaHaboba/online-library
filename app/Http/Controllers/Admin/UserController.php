<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Fetch and display all students along with their borrowed books count
    public function index()
    {
        // Fetch all students with the count of borrowed books
        $students = User::where('role', 'student')
                        ->withCount('borrowedBooks')  // Assuming borrowedBooks relationship exists
                        ->get();

        // Pass the data to the view
        return view('admin.students.index', compact('students'));
    }
    
    // Search students by ID

    public function searchForm(Request $request){
        return view('admin.students.search');
    }

    public function search(Request $request)
    {
        // dd($request);
        $studentId = $request->input('student_id');

        // Validate that student ID is provided
        $request->validate([
            'student_id' => 'required|integer',
        ]);

        // Find the student by ID
        $student = User::where('role', 'student')->where('id', $studentId)->first();

        if (!$student) {
            return back()->with('error', 'Student not found.');
        }

        // Redirect to the student details page
        return redirect()->route('admin.students.show', ['id' => $student->id]);
    }

    // Display student details
    // Show the student profile with borrowed books
    public function show($id)
    {
        // Fetch the student by ID
        $student = User::with('borrowedBooks.book')->findOrFail($id); // Eager load borrowed books and book details

        // Pass the student and their borrowed books to the view
        return view('admin.students.show', compact('student'));
    }
}
