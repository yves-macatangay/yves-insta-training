@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="row justify-content-center">
    <div class="col-8">
        <form action="{{ route('profile.update') }}" method="post" class="bg-white shadow rounded-3 p-5" enctype="multipart/form-data">
            @csrf 
            @method('PATCH')

            <h2 class="h3 mb-3 fw-light text-muted">Update Profile</h2>

            <div class="row mb-3">
                <div class="col-4">
                    @if($user->avatar)
                        <img src="{{ asset('storage/avatars/'.$user->avatar) }}" alt="{{ $user->avatar }}" class="img-thumbnail rounded-circle d-block mx-auto profile-avatar">
                    @else
                        <i class="fa-solid fa-circle-user text-secondary d-block text-center profile-icon"></i>
                    @endif
                </div>

                <div class="col-auto align-self-end">
                    <input type="file" name="avatar" id="avatar" class="form-control form-control-sm mt-1" aria-describedby="avatar-info">
                    <div id="avatar-info" class="form-text">
                        Acceptable formats: jpeg, jpg, png, gif only <br>
                        Max file size is 1048 KB
                    </div>

                    <!-- error -->
                    @error('avatar')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control" autofocus>
                <!-- error -->
                @error('name')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control">
                <!-- error -->
                @error('email')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="introduction" class="form-label fw-bold">Introduction</label>
                <textarea name="introduction" id="introduction" rows="5" class="form-control">{{ old('introduction', $user->introduction) }}</textarea>
                <!-- error -->
                @error('introduction')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-warning px-5">Save</button>

        </form>



        <!-- Edit password -->
        <form action="{{ route('profile.updatePassword') }}" method="post" class="mt-5 bg-white shadow rounded-3 p-5">
            @csrf 
            @method('PATCH')

            @if(session('success_password'))
            <p class="text-success">{{ session('success_password') }}</p>
            @endif
            <h2 class="h3 mb-3 fw-light text-muted">Update Password</h2>

            <div class="mb-3">
                <label for="current-password" class="form-label fw-bold">Old Password</label>
                <input type="password" name="current_password" id="current-password" class="form-control">

                @if(session('current_password_error'))
                    <p class="text-danger small">{{ session('current_password_error') }}</p>
                @endif
                @error('error_password')
                <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="new-password" class="form-label fw-bold">New Password</label>
                <input type="password" name="new_password" id="new-password" class="form-control">

                <label for="new-password-confirmation" class="form-label">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="new-password-confirmation" class="form-control">
            </div>
            @if(session('new_password_error'))
                <p class="text-danger small">{{ session('new_password_error') }}</p>
            @endif
            @error('new_password')
                <p class="text-danger small">{{ $message }}</p>
            @enderror

            <button type="submit" class="btn btn-warning px-5">Update Password</button>
        </form>
    </div>
</div>
@endsection