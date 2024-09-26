@extends('adminlte::page')


@section('content')
    <div class="container">
        <h1>Profile Details</h1>

        <table class="table">
            <tr>
                <th>Name</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Registered On</th>
                <td>{{ $user->created_at->format('Y-m-d') }}</td>
            </tr>
        </table>

        <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
    </div>
@endsection
