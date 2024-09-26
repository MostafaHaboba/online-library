@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>All Students</h1>

        @if($students->isEmpty())
            <div class="alert alert-info">
                No students found.
            </div>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Borrowed Books</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>
                                <a href="{{ route('admin.students.show', $student->id) }}">
                                    {{ $student->name }}
                                </a>
                            </td>
                            <td>{{ $student->borrowed_books_count }}</td> <!-- Display the borrowed books count -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination (optional, if needed) -->
            <div class="d-flex justify-content-center">
                {{-- {{ $students->links('vendor.pagination.bootstrap-4') }} --}}
            </div>
        @endif
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
