@extends('adminlte::page')
@section('title', 'Admin Dashboard - Online Library ')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>

    <div class="row mt-4">
        <!-- First Row -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Total Borrowed Books
                </div>
                <div class="card-body">
                    <h3>{{ $borrowedBooksCount }}</h3>
                    <a href="{{ route('admin.borrowed-books') }}" class="btn btn-primary">View Borrowed Books</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    Total Students
                </div>
                <div class="card-body">
                    <h3>{{ $studentsCount }}</h3>
                    <a href="{{ route('admin.students.index') }}" class="btn btn-success">View Students</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-info text-white">
                    Available Books
                </div>
                <div class="card-body">
                    <h3>{{ $availableBooksCount }}</h3>
                    <a href="{{ route('admin.books.index') }}" class="btn btn-info">View Available Books</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Second Row -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Out of Stock Books
                </div>
                <div class="card-body">
                    <h3>{{ $outOfStockBooksCount }}</h3>
                    <a href="{{ route('admin.OutOfStockBooks') }}" class="btn btn-dark">View Out of Stock Books</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    Overdue Books
                </div>
                <div class="card-body">
                    <h3>{{ $overdueBooksCount }}</h3>
                    <a href="{{ route('admin.overdue-books') }}" class="btn btn-danger">View Overdue Books</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    Recently Added Books
                </div>
                <div class="card-body">
                    <h3>{{ $recentlyAddedBooksCount }}</h3>
                    <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">View All Books</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Third Row - Search Card -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    Search Students
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.students.search') }}" method="GET">
                        @csrf
                        <input type="text" name="student_id" class="form-control" placeholder="Enter student ID"
                               required pattern="[0-9]*" inputmode="numeric">
                        <button type="submit" class="btn btn-warning mt-2">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

        

</div>
@endsection
