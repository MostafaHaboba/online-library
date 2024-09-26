@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Search Student</h1>

        <!-- Display any errors -->
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('admin.students.search') }}" method="GET">
            @csrf
            <div class="form-group">
                <label for="student_id">Student ID</label>
                <input type="number" name="student_id" class="form-control" required>
                @error('student_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-2">Search</button>
        </form>
    </div>
@endsection
