<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    // Display a listing of the books
    public function index()
    {
        $books = Book::paginate(10);
        return view('admin.books.index', compact('books'));
    }

    // Show the form for creating a new book
    public function create()
    {
        return view('admin.books.create');
    }

    // Store a newly created book in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'quantity' => 'nullable|integer|min:0',
        ]);

        Book::create($request->all());

        return redirect()->route('admin.books.index')->with('success', 'Book added successfully!');
    }

    // Show the form for editing the specified book
    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    // Update the specified book in the database
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'quantity' => 'nullable|integer|min:0',
        ]);

        $book->update($request->all());

        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully!');
    }

    // Remove the specified book from the database
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully!');
    }
}
