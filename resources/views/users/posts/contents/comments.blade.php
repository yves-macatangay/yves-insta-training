<div class="mt-3">
    <!-- show all comments here -->
    @if($post->comments->isNotEmpty())
        <hr>
        <ul class="list-group">
            @foreach($post->comments->take(3) as $comment)
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

            @if($post->comments->count()>3)
                <li class="list-group-item border-0 px-0 pt-0">
                    <a href="{{ route('post.show',$post->id) }}" class="text-decoration-none small">View all {{ $post->comments->count() }} comments</a>
                </li>
            @endif
        </ul>
    @endif

    <!-- form for adding comment -->
    <form action="{{ route('comment.store', $post->id) }}" method="post">
        @csrf 

        <div class="input-group">
            <textarea name="comment_body{{ $post->id }}" id="" rows="1" class="form-control form-control-sm">{{ old('comment_body'.$post->id) }}</textarea>
            <button type="submit" class="btn btn-outline-secondary btn-sm">Post</button>
        </div>
        <!-- Error -->
        @error('comment_body'.$post->id)
            <p class="text-danger small">{{ $message }}</p>
        @enderror
    </form>
</div>