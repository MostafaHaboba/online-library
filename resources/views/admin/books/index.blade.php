@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Books</h1>
        <a href="{{ route('admin.books.create') }}" class="btn btn-primary mb-3">Add New Book</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->quantity ?? 'Out of Stock' }}</td>
                        <td>
                            <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
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

    </div>
@endsection
