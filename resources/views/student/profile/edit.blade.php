@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Edit Profile</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('student.profile.update') }}" method="POST">
            @csrf

            <!-- Name field -->
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email field -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password field (optional) -->
            <div class="form-group">
                <label for="password">Password (leave blank to keep current password)</label>
                <input type="password" name="password" class="form-control">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password confirmation -->
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary mt-3">Update Profile</button>
        </form>
    </div>
@endsection
