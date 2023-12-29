@extends('layouts.app')

@section('title', 'Home')

@section('content')

<div class="row gx-5">
    <div class="col-8">
        @forelse($all_posts as $post)
            <div class="card mb-4">
                {{-- title --}}
                @include('users.posts.contents.title')
                {{-- body --}}
                <div class="container p-0">
                    <a href="{{ route('post.show', $post->id)}}">
                        <img src="{{ $post->image }}" alt="" class="w-100">
                    </a>
                </div>
                <div class="card-body">
                    @include('users.posts.contents.body')
                    @include('users.posts.contents.comments')
                </div>
            </div>
        @empty 
            <div class="text-center">
                <h2>Share Photos</h2>
                <p class="text-muted">When you share photos, they'll appear on your profile.</p>
                <a href="{{ route('post.create') }}" class="text-decoration-none">Share your first photo</a>
            </div>
        @endforelse
    </div>
    <div class="col-4 bg-secondary">
        PROFILE OVERVIEW 


        SUGGESTIONS
    </div>
</div>

@endsection