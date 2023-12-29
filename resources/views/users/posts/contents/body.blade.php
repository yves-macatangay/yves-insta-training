{{-- heart button + no. of likes --}}
<div class="row align-items-center">
    <div class="col-auto">
        <form action="" method="post">
            @csrf 
            <button type="submit" class="btn btn-sm shadow-none p-0"><i class="fa-regular fa-heart"></i></button>
        </form>
    </div>

    <div class="col-auto px-0">
        0
    </div>

    <div class="col text-end">
        @foreach($post->categoryPosts as $category_post)
            <div class="badge bg-secondary bg-opacity-50">
                {{ $category_post->category->name }}
            </div>
        @endforeach
    </div>

</div>

<!-- owner & description -->
<a href="{{ route('profile.show', $post->user_id)}}" class="text-decoration-none text-dark fw-bold">{{ $post->user->name }}</a>
&nbsp;
<p class="d-inline fw-light">{{ $post->description }}</p>
<p class="text-uppercase text-muted xsmall">{{ date('M d, Y', strtotime($post->created_at)) }}</p>