@extends('adminlte::page')
@section('title','Student Dashboard - Online Library')

@section('content')
    <div class="container">
        <h1>My Borrowed Books</h1>
        @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

        @if($borrowedBooks->isEmpty())
            <div class="alert alert-info">
                You have not borrowed any books.
            </div>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Borrowed Date</th>
                        <th>Return Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($borrowedBooks as $borrowedBook)
                        <tr>
                            <td>{{ $borrowedBook->book->title }}</td>
                            <td>{{ $borrowedBook->borrowed_at ? \Carbon\Carbon::parse($borrowedBook->borrowed_at)->format('Y-m-d') : 'N/A' }}</td>
                            <td>{{ $borrowedBook->return_date? \Carbon\Carbon::parse($borrowedBook->return_date)->format('Y-m-d'):'N/A' }}</td>
                            <td>
                                <!-- Return Book Button -->
                                <form action="{{ route('student.books.return', $borrowedBook->book->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Return Book</button>
                                </form>
                            </td>
                        </tr>
                        
                        
                    @endforeach
                </tbody>
            </table>
                <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $borrowedBooks->links('vendor.pagination.bootstrap-4') }}
    </div>

        @endif
    </div>
@endsection
