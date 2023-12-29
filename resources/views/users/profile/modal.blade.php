<div class="modal fade" id="recent-comments">
    <div class="modal-dialog">
        <div class="modal-content border-secondary">
            <div class="modal-header border-secondary">
                <p class="text-muted h5">Recent Comments</p>
            </div>

            <div class="modal-body" style="overflow-y:scroll; height:300px">
                @forelse($user->comments->take(5) as $comment)
                <div class="rounded-2 border border-primary py-2 px-3 text-muted mb-2">
                    <div>{{ $comment->body }}</div>
                    <hr>
                    <div class="small">Replied to <a href="{{ route('post.show', $comment->post_id ) }}" class="text-decoration-none">{{ $comment->post->user->name }}'s post</a></div>
                </div>
                @empty
                <p class="text-center text-muted">No recent comments.</p>
                @endforelse
            </div>
            
            <div class="modal-footer border-0">
                <button data-bs-dismiss="modal" class="btn btn-sm btn-outline-secondary">Close</button>
            </div>

        </div>
    </div>
</div>