@extends('layouts.app')

@section('title', 'Show Post')

@section('content')
<style>
.col-4 {
    overflow-y:scroll;
}
.card-body {
    position:absolute;
    top:65px;
}
</style>
<div class="row border shadow">
    <div class="col p-0 border-end">
        <img src="{{ $post->image }}" alt="" class="w-100">
    </div>
    <div class="col-4 px-0 bg-white">
        <div class="card border-0">
            @include('users.posts.contents.title')
            <div class="card-body w-100">
                @include('users.posts.contents.body')

                <form action="{{ route('comment.store', $post->id) }}" method="post">
                    @csrf 

                    <div class="input-group">
                        <textarea name="comment_body{{ $post->id }}" id="" cols="30" rows="1" class="form-control form-control-sm">{{ old('comment_body'.$post->id) }}</textarea>
                        <button type="submit" class="btn btn-outline-secondary btn-sm">Post</button>
                    </div>
                    <!-- Error -->
                </form>

                <!-- Show all comments -->
                @if($post->comments->isNotEmpty())
                <ul class="list-group mt-2">
                    @foreach($post->comments as $comment)
                    <li class="list-group-item border-0 p-0 mb-2">
                        <a href="{{ route('profile.show', $comment->user_id)}}" class="text-decoration-none text-dark fw-bold">{{ $comment->user->name }}</a>
                        &nbsp;
                        <p class="d-inline fw-light">{{ $comment->body }}</p>
                        <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                            @csrf 
                            @method('DELETE')

                            <span class="small text-muted">{{ date('D, M d Y', strtotime($comment->created_at)) }}</span>

                            @if(Auth::user()->id == $comment->user->id)
                            &middot;
                            <button type="submit" class="border-0 bg-transparent text-danger p-0 small">Delete</button>
                            @endif
                        </form>
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection