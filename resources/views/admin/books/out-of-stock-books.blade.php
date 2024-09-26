@extends('adminlte::page')
@section('title', 'Out of Stock Books - Online Library')

@section('content')
    <div class="container">
        <h1>Out of Stock Books</h1>

        @if($outOfStockBooks->isEmpty())
            <div class="alert alert-info">
                There are no out-of-stock books currently.
            </div>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($outOfStockBooks as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->created_at->format('Y-m-d') }}</td>
                            <td>{{ $book->updated_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
