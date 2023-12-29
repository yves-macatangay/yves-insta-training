@extends('layouts.app')

@section('title', 'Admin: Users')

@section('content')

<form action="{{ route('admin.users') }}" class="mb-3">
    <input type="search" name="search" value="{{ $search }}" class="form-control ms-auto" style="width:10rem" placeholder="Search for names">
</form>

<table class="table table-hover align-middle bg-white border text-secondary">
    <thead class="small table-success text-secondary">
        <tr>
            <th></th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>CREATED AT</th>
            <th>STATUS</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($all_users as $user)
        <tr>
            <td>
                @if($user->avatar)
                    <img src="{{ asset('storage/avatars/'.$user->avatar) }}" alt="" class="rounded-circle d-block mx-auto admin-users-avatar">
                @else
                    <i class="fa-solid fa-circle-user d-block text-center admin-users-icon"></i>
                @endif
            </td>

            <td>
                <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $user->name }}</a>
            </td>

            <td>{{ $user->email }}</td>

            <td>{{ $user->created_at }}</td>

            <td>
                @if($user->trashed())
                    <i class="fa-regular fa-circle text-secondary"></i> Inactive
                @else
                    <i class="fa-solid fa-circle text-success"></i> Active
                @endif
            </td>

            <td>
                @if(Auth::user()->id !== $user->id)
                    <div class="dropdown">
                        <button class="btn btn-sm" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-ellipsis"></i>
                        </button>

                        <div class="dropdown-menu">
                            @if($user->trashed())
                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#activate-user-{{ $user->id }}">
                                <i class="fa-solid fa-user-check"></i> Activate {{ $user->name }}
                            </button>
                            @else
                            <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deactivate-user-{{ $user->id }}">
                                <i class="fa-solid fa-user-slash"></i> Deactivate {{ $user->name }}
                            </button>
                            @endif
                        </div>
                    </div>
                    <!-- Include modal here -->
                    @include('admin.users.modal.status')
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $all_users->links() }}
@endsection