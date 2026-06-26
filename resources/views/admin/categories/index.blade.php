@extends('layouts.admin')

@section('content')
<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h1>Categories</h1>
        <a class="btn" href="{{ route('categories.create') }}">Add Category</a>
    </div>
    <table>
        <thead>
            <tr><th>Name</th><th>Slug</th><th>Status</th><th></th></tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->is_active ? 'Active' : 'Hidden' }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category) }}">Edit</a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
