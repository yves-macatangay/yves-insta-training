@extends('layouts.app')

@section('title', 'Followers')

@section('content')
@include('users.profile.header')

<div class="mt-5">
    @if($user->followeds->isNotEmpty())
        <div class="row justify-content-center">
            <div class="col-4">
                <h3 class="text-muted text-center">Following</h3>

                @foreach($user->followeds as $following)
                    <div class="row align-items-center mt-3">
                        <div class="col-auto">
                            <a href="{{ route('profile.show', $following->followed->id) }}">
                                @if($following->followed->avatar)
                                    <img src="{{ $following->followed->avatar }}" alt="{{ $following->followed->avatar }}" class="rounded-circle avatar-sm">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                @endif
                            </a>
                        </div>

                        <div class="col ps-0 text-truncate">
                            <a href="{{ route('profile.show', $following->followed->id) }}" class="text-decoration-none text-dark fw-bold small">{{ $following->followed->name }}</a>
                        </div>

                        <div class="col-auto text-end">
                            @if($following->followed->id != Auth::user()->id)
                                @if($following->followed->isFollowed())
                                <form action="{{ route('follow.destroy', $following->followed->id) }}" method="post" class="d-inline">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="border-0 bg-transparent p-0 text-secondary btn-sm">Following</button>
                                </form>
                                @else
                                <form action="{{ route('follow.store', $following->followed->id) }}" method="post" class="d-inline">
                                    @csrf 
                                    <button type="submit" class="border-0 bg-transparent p-0 text-primary btn-sm">Follow</button>
                                </form>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <h3 class="text-muted text-center">Not following anyone yet.</h3>
    @endif
</div>
@endsection