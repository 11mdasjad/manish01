@extends('layouts.admin')

@section('title', 'Admin Profile & Security')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Administrator Profile & Security</h2>
    <p class="text-muted text-sm mb-0">Update your account credentials, avatar, and authentication password.</p>
  </div>
</div>

<div class="row g-4 max-w-4xl">
  {{-- Profile Details --}}
  <div class="col-lg-6">
    <div class="card border-0 shadow-sm rounded-3 p-4 bg-white h-100">
      <h5 class="fw-bold mb-3 border-bottom pb-2">Profile Information</h5>

      <form action="{{ route('admin.profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Full Name</label>
          <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Executive Email</label>
          <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Phone Number</label>
          <input type="tel" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
        </div>

        <div class="mb-4">
          <label class="form-label text-xs fw-bold">Avatar Image Web URL</label>
          <input type="url" name="avatar" class="form-control" value="{{ old('avatar', $user->avatar) }}">
        </div>

        <button type="submit" class="hm-btn hm-btn-primary fw-bold">
          <i class="bi bi-save me-1"></i> Update Profile
        </button>
      </form>
    </div>
  </div>

  {{-- Password Change --}}
  <div class="col-lg-6">
    <div class="card border-0 shadow-sm rounded-3 p-4 bg-white h-100">
      <h5 class="fw-bold mb-3 border-bottom pb-2">Update Password</h5>

      <form action="{{ route('admin.profile.password') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Current Security Password</label>
          <input type="password" name="current_password" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">New Password (Min 8 characters)</label>
          <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-4">
          <label class="form-label text-xs fw-bold">Confirm New Password</label>
          <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="hm-btn hm-btn-gold fw-bold">
          <i class="bi bi-key-fill me-1"></i> Change Password
        </button>
      </form>
    </div>
  </div>
</div>
@endsection
