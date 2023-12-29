@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<form action="{{ route('post.update', $post->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="mb-3">
        <label for="category" class="form-label d-block fw-bold">Category 
            <span class="text-muted fw-light">(up to 3)</span></label>
        @foreach($all_categories as $category)
        <div class="form-check form-check-inline">
            @if(in_array($category->id, $selected_categories))
                <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input" checked>
            @else
                <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input">
            @endif
            <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
        </div>
        @endforeach
        @error('category')
            <p class="text-danger small">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label fw-bold">Description</label>
        <textarea name="description" id="description"  rows="3" class="form-control" placeholder="What's on your mind">{{ old('description', $post->description) }}</textarea>
        @error('description')
            <p class="text-danger small">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4 w-50">
        <label for="image" class="form-label fw-bold">Image</label>
        <img src="{{ $post->image }}" alt="" class="img-thumbnail w-100">
        <input type="file" name="image" id="image" class="form-control">
        <div class="small text-muted">
            Acceptable formats: jpeg, jpg, png, gif only<br>
            Max size is 1048 KB
        </div>
        @error('image')
            <p class="text-danger small">{{ $message }}</p>
        @enderror
    </div>

    <input type="submit" value="Save" class="btn btn-warning px-5">
</form>
@endsection