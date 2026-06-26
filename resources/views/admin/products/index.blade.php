@extends('layouts.admin')

@section('content')
<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h1>Products</h1>
        <a class="btn" href="{{ route('products.create') }}">Add Product</a>
    </div>
    <table>
        <thead>
            <tr><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th></th></tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category?->name }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product) }}">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
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
