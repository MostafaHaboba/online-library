@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>All Borrowed Books</h1>

        @if($borrowedBooks->isEmpty())
            <div class="alert alert-info">
                No books have been borrowed yet.
            </div>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Borrower Name</th>
                        <th>Borrowed Date</th>
                        <th>Return Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($borrowedBooks as $borrowedBook)
                        <tr>
                            <td>{{ $borrowedBook->book->title }}</td>
                            <td>
                                <a href="{{ route('admin.students.show', $borrowedBook->user->id) }}">
                                    {{ $borrowedBook->user->name }}
                                </a>
                            </td>
                            <td>{{ $borrowedBook->borrowed_at ? \Carbon\Carbon::parse($borrowedBook->borrowed_at)->format('Y-m-d') : 'N/A' }}</td>
                            <td>{{ $borrowedBook->return_date ? \Carbon\Carbon::parse($borrowedBook->return_date)->format('Y-m-d') : 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination (optional, if needed) -->
            <div class="d-flex justify-content-center">
                {{ $borrowedBooks->links('vendor.pagination.bootstrap-4') }}
            </div>
        @endif
    </div>
@endsection
