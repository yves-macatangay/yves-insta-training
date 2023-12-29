@extends('layouts.app')

@section('title', 'Admin: Posts')

@section('content')
<form action="{{ route('admin.posts') }}" class="mb-3">
    <input type="search" name="search" value="{{ $search }}" class="form-control ms-auto" style="width:10rem" placeholder="Search for posts">
</form>

<table class="table table-hover align-middle bg-white border text-secondary">
    <thead class="table-primary text-secondary small">
        <tr>
            <th></th>
            <th></th>
            <th>CATEGORY</th>
            <th>OWNER</th>
            <th>CREATED AT</th>
            <th>STATUS</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse($all_posts as $post)
        <tr>
            <td class="text-end">{{ $post->id }}</td>

            <td>
                <a href="{{ route('post.show', $post->id) }}">
                    <img src="{{ asset('/storage/images/'.$post->image) }}" alt="{{ $post->image }}" class="d-block mx-auto admin-posts-img">
                </a>
            </td>

            <td>
                @if($post->categoryPost->count()==0)
                    <div class="badge-bg-dark text-wrap">Uncategorized</div>
                @endif
                @foreach($post->categoryPost as $categoryPost)
                    <span class="badge bg-secondary bg-opacity-50">{{ $categoryPost->category->name }}</span>
                @endforeach
            </td>

            <td>
                <a href="{{ route('profile.show', $post->user->id) }}" class="text-dark text-decoration-none">{{ $post->user->name }}</a>
            </td>

            <td>{{ $post->created_at }}</td>

            <td>
                @if(!$post->trashed())
                <i class="fa-solid fa-circle text-primary"></i> Visible
                @else
                <i class="fa-solid fa-circle-minus text-secondary"></i> Hidden
                @endif
            </td>

            <td>
                <div class="dropdown">
                    <button class="btn btn-sm" data-bs-toggle="dropdown">
                        <t class="fa-solid fa-ellipsis"></t>
                    </button>

                    <div class="dropdown-menu">
                        @if(!$post->trashed())
                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#hide-post-{{ $post->id }}">
                            <i class="fa-solid fa-eye-slash"></i> Hide Post {{ $post->id }}
                        </button>
                        @else
                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unhide-post-{{ $post->id }}">
                            <i class="fa-solid fa-eye"></i> Unhide Post {{ $post->id }}
                        </button>
                        @endif
                    </div>
                </div>
            </td>
        </tr>
        <!-- Modal here -->
        @include('admin.posts.modal.status')
        @empty
        <tr>
            <td colspan="7" class="lead text-muted text-center">
                No posts found.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
{{ $all_posts->links() }}
@endsection