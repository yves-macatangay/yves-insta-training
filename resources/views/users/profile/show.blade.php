@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <!-- profile header -->
    @include('users.profile.header')

    <!-- all posts by user -->
    <div class="mt-5">
        @if($user->posts->isNotEmpty())
            <div class="row">
                @foreach($user->posts as $post)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <a href="{{ route('post.show',$post->id) }}">
                            <img src="{{ $post->image }}" alt="{{ $post->image }}" class="grid-img">
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <h3 class="text-muted text-center">No posts yet.</h3>
        @endif
    </div>
@endsection