@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Student Details</h1>

        <!-- Student Information -->
        <table class="table">
            <tr>
                <th>ID</th>
                <td>{{ $student->id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $student->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $student->email }}</td>
            </tr>
            <tr>
                <th>Created At</th>
                <td>{{ $student->created_at ? $student->created_at->format('Y-m-d') : 'N/A' }}</td>
            </tr>
        </table>

        <!-- Borrowed Books Information -->
        <h2>Borrowed Books ({{ $student->borrowedBooks->count() }})</h2>

        @if($student->borrowedBooks->isEmpty())
            <div class="alert alert-info">
                This student has not borrowed any books.
            </div>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Borrowed Date</th>
                        <th>Return Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($student->borrowedBooks as $borrowedBook)
                        <tr>
                            <td>{{ $borrowedBook->book->title }}</td>
                            <td>{{ $borrowedBook->borrowed_at ? \Carbon\Carbon::parse($borrowedBook->borrowed_at)->format('Y-m-d') : 'N/A' }}</td>
                            <td>{{ $borrowedBook->return_date ? \Carbon\Carbon::parse($borrowedBook->return_date)->format('Y-m-d') : 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <!-- Back Button -->
        <a href="{{ route('admin.students.searchForm') }}" class="btn btn-secondary">Back to Search</a>
    </div>
@endsection
