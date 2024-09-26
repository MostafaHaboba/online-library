<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BorrowedBook;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    //
    public function index()
    {
        // Count the total number of borrowed books
        $borrowedBooksCount = BorrowedBook::count();

        // Count the total number of students (where role is 'student')
        $studentsCount = User::where('role', 'student')->count();

        // Count the total number of available books
        $availableBooksCount = Book::where('quantity', '>', 0)->count();

        // Count overdue books (where the return date is past today)
        $overdueBooksCount = BorrowedBook::where('return_date', '<', Carbon::now())->count();

        // Count recently added books (e.g., added in the last 30 days)
        $recentlyAddedBooksCount = Book::where('created_at', '>=', Carbon::now()->subDays(30))->count();

        $outOfStockBooksCount = Book::where('quantity', Null)->count();

        // Pass the data to the view
        return view('admin.dashboard', compact(
            'borrowedBooksCount',
            'studentsCount',
            'availableBooksCount',
            'overdueBooksCount',
            'recentlyAddedBooksCount',
            'outOfStockBooksCount'
        ));
    }
    // public function RedirectToDashboard(){
    //     return redirect('/dashboard');
    // }

    // Method to view all borrowed books
    public function borrowedBooks()
    {
        // Fetch all borrowed books with the related book and user data
        $borrowedBooks = BorrowedBook::with('book', 'user')->paginate(10);

        // Pass the data to the view
        return view('admin.borrowed_books.index', compact('borrowedBooks'));
    }
    public function overdueBooks()
    {
        // Fetch all overdue books along with the borrower information (user)
        $overdueBooks = BorrowedBook::where('return_date', '<', Carbon::now())
                                    ->with('user', 'book')  // Assuming BorrowedBook has a relationship with User and Book
                                    ->get();

        // Pass the data to the view
        return view('admin.borrowed_books.overdue-books', compact('overdueBooks'));
    }

    public function OutOfStockBooks()
    {
        // Fetch all books where the quantity is zero
        $outOfStockBooks = Book::where('quantity', Null)->get();

        // Return the view with the out-of-stock books data
        return view('admin.books.out-of-stock-books', compact('outOfStockBooks'));
    }


}
