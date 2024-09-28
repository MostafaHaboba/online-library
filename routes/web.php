<?php

use App\Http\Controllers\HomeController;
use Illuminate\Routing\Controllers\Middleware;


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Student\BookController as StuBookController;
use App\Http\Controllers\Student\BorrowedBookController as StuBorrowedBookController;
use App\Http\Controllers\Student\ProfileController as StuProfileController;;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


// Admin routes
Route::middleware(['auth','admin'])->name('admin.')->group(function () {

    // Admin dashboard (View borrowed books, all books, and all users)
    Route::get('/dashboard', action: [AdminController::class, 'index'])->name('dashboard');
    route::get('/borrowed-books', [AdminController::class, 'borrowedBooks'])->name('borrowed-books');
    route::get('/overdue-books', [AdminController::class, 'overdueBooks'])->name('overdue-books');
    route::get('/out-of-stock-books', [AdminController::class, 'OutOfStockBooks'])->name('OutOfStockBooks');

    // Book management routes
    Route::resource('books', BookController::class);

    // User management (search students by ID, view student details)
    route::get('students', [UserController::class, 'index'])->name('students.index');

    Route::get('students/search', [UserController::class, 'searchForm'])->name('students.searchForm');
    Route::get('students/search_action', [UserController::class, 'search'])->name('students.search');
    Route::get('students/{id}', [UserController::class, 'show'])->name('students.show');

    // Admin profile management
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('profile/view', [ProfileController::class, 'show'])->name('profile.show');

});


// Student routes
Route::middleware(['auth', 'student'])->prefix('student')->name('student.')->group(function () {

    // Student dashboard (View borrowed books and return dates)
    Route::get('/dashboard', [StuBorrowedBookController::class, 'studentDashboard'])->name('dashboard');

    // View available books (read-only for students)
    Route::get('/books', [StuBookController::class, 'index'])->name('books.index');

    // Borrow and return books
    Route::post('/books/borrow/{book}', [StuBorrowedBookController::class, 'borrow'])->name('books.borrow');
    Route::post('/books/return/{book}', [StuBorrowedBookController::class, 'return'])->name('books.return');

    // Student profile management
    Route::get('profile', [StuProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile', [StuProfileController::class, 'update'])->name('profile.update');
    route::get('profile/view', [StuProfileController::class, 'show'])->name('profile.show');
});

Route::get('/notadmin',[homeController::class,'notadmin']);
Route::get('/notstudent',[homeController::class,'notstudent']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
