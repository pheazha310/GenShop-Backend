@extends('layouts.admin')

@section('content')
<div class="card">
    <h1>{{ $category->exists ? 'Edit Category' : 'Create Category' }}</h1>
    <form method="POST" action="{{ $category->exists ? route('categories.update', $category) : route('categories.store') }}">
        @csrf
        @if($category->exists) @method('PUT') @endif
        <label>Name<input name="name" value="{{ old('name', $category->name) }}"></label>
        <label>Description<textarea name="description" rows="5">{{ old('description', $category->description) }}</textarea></label>
        <label><input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }}> Active</label>
        <button class="btn" type="submit">Save</button>
    </form>
</div>
@endsection
