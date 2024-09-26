<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use App\Models\BorrowedBook;


class BorrowedBookController extends Controller
{
    // Display student dashboard with borrowed books and return dates
    public function studentDashboard()
    {
        // Get all borrowed books for the currently authenticated student
        $borrowedBooks = BorrowedBook::where('user_id', Auth::id())
                                      ->with('book') // Assuming the relationship between BorrowedBook and Book
                                      ->paginate(10);

        // Return the view with the borrowed books data
        return view('student.dashboard', compact('borrowedBooks'));
    }
    public function borrow($bookId)
    {
        // Check if the user has overdue books
        $hasOverdueBooks = BorrowedBook::where('user_id', Auth::id())
                                       ->where('return_date', '<', now())
                                       ->exists();
    
        if ($hasOverdueBooks) {
            return redirect()->route('student.dashboard')->with('error', 'You have overdue books. Please return them before borrowing more.');
        }
    
        // Check if the user has already borrowed this book
        $alreadyBorrowed = BorrowedBook::where('user_id', Auth::id())
                                       ->where('book_id', $bookId)
                                       ->exists();
    
        if ($alreadyBorrowed) {
            return redirect()->route('student.dashboard')->with('error', 'You have already borrowed this book.');
        }
    
        // Find the book by ID
        $book = Book::findOrFail($bookId);
    
        if ($book->quantity > 0) {
            // Create a record in the borrowed_books table
            BorrowedBook::create([
                'user_id' => Auth::id(),
                'book_id' => $book->id,
                'borrowed_at' => now(),
                'return_date' => now()->addDays(14), // Set return date after 14 days
            ]);
    
            // Decrease the book quantity
            $book->decrement('quantity');
    
            return redirect()->route('student.dashboard')->with('success', 'Book borrowed successfully!');
        }
    
        return back()->with('error', 'The book is no longer available.');
    }
        
    public function return($bookId)
{
    // Find the borrowed book record
    $borrowedBook = BorrowedBook::where('book_id', $bookId)
                                ->where('user_id', Auth::id())
                                ->firstOrFail();

    // Delete the borrowed book record
    $borrowedBook->delete();

    // Increment the book quantity
    $book = Book::findOrFail($bookId);
    $book->increment('quantity');

    return redirect()->route('student.dashboard')->with('success', 'Book returned successfully!');
}

public function RedirectToDashboard(){
    return redirect('/stu/dashboard');
}

}
