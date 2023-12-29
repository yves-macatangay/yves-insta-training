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
    <div class="col-4">
         <!-- Profile Overview -->
        <div class="row align-items-center mb-5 bg-white shadow-sm rounded-3 py-3">
            <div class="col-auto">
                <a href="{{ route('profile.show', Auth::user()->id) }}">
                    @if(Auth::user()->avatar)
                        <img src="{{ Auth::user()->avatar }}" alt="" class="rounded-circle avatar-md">
                    @else
                        <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                    @endif
                </a>
            </div>

            <div class="col ps-0">
                <a href="{{ route('profile.show', Auth::user()->id) }}" class="text-decoration-none text-dark fw-bold small">{{ Auth::user()->name }}</a>
                <p class="text-muted small">{{ Auth::user()->email }}</p>
            </div>
        </div>


        SUGGESTIONS
    </div>
</div>

@endsection