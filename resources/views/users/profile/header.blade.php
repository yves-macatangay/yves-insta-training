<div class="row">
    <div class="col-4">
        <button class="border-0 bg-transparent p-0 shadow-none" data-bs-toggle="modal" data-bs-target="#recent-comments">
            @if($user->avatar)
                <img src="{{ asset('storage/avatars/'.$user->avatar) }}" alt="{{ $user->avatar }}" class="img-thumbnail rounded-circle d-block mx-auto image-lg">
            @else
                <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>
            @endif
        </button>
        @include('users.profile.modal')
    </div>
        
    <div class="col-8">
        <div class="row mb-3">
            <div class="col-auto">
                <h2 class="display-6 d-inline">{{ $user->name }}</h2>
            </div>

            <div class="col-auto p-2">
                @if(Auth::user()->id == $user->id)
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-sm fw-bold">Edit Profile</a>
                @else
                    @if($user->isFollowed())
                    <form action="{{ route('follow.destroy', $user->id) }}" method="post" class="d-inline">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-secondary btn-sm fw-bold">Following</button>
                    </form>
                    @else
                    <form action="{{ route('follow.store', $user->id) }}" method="post" class="d-inline">
                        @csrf 
                        <button type="submit" class="btn btn-primary btn-sm fw-bold">Follow</button>
                    </form>
                    @endif
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-auto">
                <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark">
                    <strong>{{ $user->posts->count() }}</strong> {{ $user->posts->count() == 1 ? 'post' : 'posts' }}
                </a>
            </div>

            <div class="col-auto">
                <a href="{{ route('profile.followers', $user->id) }}" class="text-decoration-none text-dark">
                    <strong>{{ $user->followers->count() }}</strong> {{ $user->followers->count()==1 ? 'follower' : 'followers'}}
                </a>
            </div>

            <div class="col-auto">
                <a href="{{ route('profile.following', $user->id) }}" class="text-decoration-none text-dark">
                    <strong>{{ $user->followeds->count() }}</strong> following
                </a>
            </div>

        </div>

        <div class="row">
            <p class="fw-bold">{{ $user->introduction }}</p>
        </div>
    </div>
</div>