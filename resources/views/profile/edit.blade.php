@extends('layouts.app')
@section('title', 'Profile')
@section('page-title', '👤 My Profile')

@section('content')
<div class="card p-4" style="max-width:600px;">
    <h6 class="fw-bold mb-4">Profile Update Karein</h6>

    @if(session('success'))
        <div class="alert alert-success py-2 rounded-3">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf @method('PATCH')

        <div class="mb-3">
            <label class="form-label fw-semibold">Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name) }}">
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email) }}">
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary px-4">
            <i class="bi bi-save me-1"></i> Save Changes
        </button>
    </form>
</div>
@endsection