@extends('layouts.admin')

@section('content')
<div class="card">
    <h1>Users</h1>
    <table>
        <thead>
            <tr><th>Name</th><th>Email</th><th>Role</th></tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->is_admin ? 'Admin' : 'Customer' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
