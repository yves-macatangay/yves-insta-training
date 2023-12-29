@extends('layouts.app')

@section('title', 'Suggested Users')

@section('content')
<div class="row justify-content-center">
    <div class="col-4">
        <form action="{{ route('suggested-users') }}" method="get" class="mb-4">
            <input type="text" name="search" value="{{ $search }}" style="width:15rem" class="form-control form-control-sm" placeholder="Search names...">
        </form>
        @forelse($users as $user)

        <div class="row align-items-center mb-3">
            <div class="col-auto">
                <a href="{{ route('profile.show', $user->id) }}">
                    @if($user->avatar)
                        <img src="{{ asset('storage/avatars/'. $user->avatar) }}" alt="{{ $user->avatar }}" class="rounded-circle user-avatar">
                    @else
                        <i class="fa-solid fa-circle-user text-secondary user-icon"></i>
                    @endif
                </a>
            </div>

            <div class="col ps-0 text-truncate">
                <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark fw-bold small">{{ $user->name }}</a>
            </div>

            <div class="col-auto">
                <form action="{{ route('follow.store', $user->id) }}" method="post" class="d-inline">
                    @csrf 
                    <button type="submit" class="border-0 bg-transparent p-0
                    text-primary btn-sm">Follow</button>
                </form>
            </div>
        </div>
        @empty
        <p class="text-center text-muted">No users found.</p>

        @endforelse
    </div>
</div>
@endsection