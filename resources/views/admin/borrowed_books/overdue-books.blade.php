@extends('adminlte::page')
@section('title', 'Overdue Books - Online Library')

@section('content')
    <div class="container">
        <h1>Overdue Books</h1>

        @if($overdueBooks->isEmpty())
            <div class="alert alert-info">
                No overdue books found.
            </div>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Borrower Name</th>
                        <th>Borrowed Date</th>
                        <th>Return Date</th>
                        <th>Days Overdue</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($overdueBooks as $overdueBook)
                        <tr>
                            <td>{{ $overdueBook->book->title }}</td>
                            <td>{{ $overdueBook->user->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($overdueBook->borrowed_at)->format('Y-m-d') }}</td>
                            <td>{{ \Carbon\Carbon::parse($overdueBook->return_date)->format('Y-m-d') }}</td>
                            <td>
                                {{ abs(\Carbon\Carbon::parse($overdueBook->return_date)->diffInDays(\Carbon\Carbon::now(), false)) }} days overdue
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
