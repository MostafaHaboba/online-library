@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Available Books</h1>

        @if($books->isEmpty())
            <div class="alert alert-info">
                No books are available for borrowing at the moment.
            </div>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Available Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->quantity }}</td>
                            <td>
                                <form action="{{ route('student.books.borrow', $book->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Borrow</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $books->links('vendor.pagination.bootstrap-4') }}
    </div>
            
        @endif
        
    </div>
@endsection
