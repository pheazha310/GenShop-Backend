@extends('layouts.admin')

@section('content')
<div class="card">
    <h1>{{ $product->exists ? 'Edit Product' : 'Create Product' }}</h1>
    <form method="POST" action="{{ $product->exists ? route('products.update', $product) : route('products.store') }}">
        @csrf
        @if($product->exists) @method('PUT') @endif
        <label>Category
            <select name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </label>
        <label>Name<input name="name" value="{{ old('name', $product->name) }}"></label>
        <label>Description<textarea name="description" rows="5">{{ old('description', $product->description) }}</textarea></label>
        <label>Price<input name="price" type="number" step="0.01" value="{{ old('price', $product->price) }}"></label>
        <label>Stock<input name="stock" type="number" value="{{ old('stock', $product->stock) }}"></label>
        <label>Image URL<input name="image" value="{{ old('image', $product->image) }}"></label>
        <label><input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}> Active</label>
        <button class="btn" type="submit">Save</button>
    </form>
</div>
@endsection
