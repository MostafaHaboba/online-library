<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Book;

class BookController extends Controller
{
    // Display a list of available books
    public function index()
    {
        // Fetch all books with quantity greater than 0 (available for borrowing)
        $books = Book::where('quantity', '>', 0)->paginate(10); // Paginate with 10 items per page

        return view('student.books.index', compact('books'));
    }
}
