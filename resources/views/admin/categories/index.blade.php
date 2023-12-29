@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')
<form action="{{ route('admin.categories.store') }}" method="post">
    @csrf 

    <div class="row gx-2 mb-4">
        <div class="col-4">
            <input type="text" name="name" id="name" class="form-control" placeholder="Add a category..." autofocus>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add</button>
        </div>
        <!-- Error -->
        @error('name')
        <p class="text-danger small">{{ $message }}</p>
        @enderror
    </div>
</form>

<div class="row">
    <div class="col7">
        <table class="table table-hover align-middle bg-white border table-sm text-secondary text-center">
            <thead class="table-warning small text-secondary">
                <th>#</th>
                <th>NAME</th>
                <th>COUNT</th>
                <th>LAST UPDATED</th>
                <th></th>
            </thead>
            <tbody>
                @forelse($all_categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td class="text-dark">{{ $category->name }}</td>
                        <td>{{ $category->categoryPost->count() }}</td>
                        <td>{{ $category->updated_at }}</td>
                        <td>
                            <!-- Edit button -->
                            <button class="btn btn-outline-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#edit-category-{{ $category->id }}" title="Edit">
                                <i class="fa-solid fa-pen"></i>
                            </button>

                            <!-- Delete button -->
                            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-category-{{ $category->id }}" title="Delete">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                    <!-- modal here -->
                    @include('admin.categories.modal.action')
                @empty
                    <tr>
                        <td colspan="5" class="lead text-muted text-center">No categories found.</td>
                    </tr>
                @endforelse
                <tr>
                <td>0</td>
                    <td class="text-muted">Uncategorized</td>
                    <td>{{ $uncategorized_count }}</td>
                    <td></td>
                    <td>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection