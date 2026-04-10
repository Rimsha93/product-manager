@extends('layouts.app')
@section('title', 'Settings')
@section('page-title', '⚙️ Settings')

@section('content')
<div class="card p-4" style="max-width:600px;">
    <h6 class="fw-bold mb-4">Account Settings</h6>

    {{-- Change Password --}}
    <form method="POST" action="{{ route('password.update') }}">
        @csrf @method('PUT')
        <h6 class="text-muted mb-3" style="font-size:0.85rem; text-transform:uppercase; letter-spacing:1px;">Change Password</h6>

        <div class="mb-3">
            <label class="form-label fw-semibold">Current Password</label>
            <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror">
            @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">New Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-4">
            <label class="form-label fw-semibold">Confirm New Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        @if(session('status') === 'password-updated')
            <div class="alert alert-success py-2">Password update ho gaya!</div>
        @endif

        <button type="submit" class="btn btn-primary px-4">Update Password</button>
    </form>
</div>
@endsection