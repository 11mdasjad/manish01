@extends('layouts.admin')

@section('title', 'Edit Team Member: ' . $member->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Edit Profile: {{ $member->name }}</h2>
    <p class="text-muted text-sm mb-0">Update title, bio, portrait visual, and contact links.</p>
  </div>
  <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary btn-sm">
    <i class="bi bi-arrow-left me-1"></i> Back to Team
  </a>
</div>

<div class="card border-0 shadow-sm rounded-3 p-4 bg-white max-w-2xl">
  <form action="{{ route('admin.team.update', $member->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-3 mb-3">
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Full Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $member->name) }}" required>
      </div>
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Designation / Title <span class="text-danger">*</span></label>
        <input type="text" name="designation" class="form-control" value="{{ old('designation', $member->designation) }}" required>
      </div>
    </div>

    <div class="row g-3 mb-3">
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Department / Division</label>
        <select name="department" class="form-select">
          <option value="Executive Board" {{ old('department', $member->department) == 'Executive Board' ? 'selected' : '' }}>Executive Board</option>
          <option value="Agro-Business & Real Estate" {{ old('department', $member->department) == 'Agro-Business & Real Estate' ? 'selected' : '' }}>Agro-Business & Real Estate</option>
          <option value="Research & Quality Assurance" {{ old('department', $member->department) == 'Research & Quality Assurance' ? 'selected' : '' }}>Research & Quality Assurance</option>
          <option value="Engineering & Construction" {{ old('department', $member->department) == 'Engineering & Construction' ? 'selected' : '' }}>Engineering & Construction</option>
          <option value="Global Trade & Supply Chain" {{ old('department', $member->department) == 'Global Trade & Supply Chain' ? 'selected' : '' }}>Global Trade & Supply Chain</option>
          <option value="Finance & Legal Affairs" {{ old('department', $member->department) == 'Finance & Legal Affairs' ? 'selected' : '' }}>Finance & Legal Affairs</option>
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Corporate Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $member->email) }}">
      </div>
    </div>

    <div class="row g-3 mb-3">
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">LinkedIn Profile URL</label>
        <input type="url" name="linkedin_url" class="form-control" value="{{ old('linkedin_url', $member->linkedin_url) }}">
      </div>
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Twitter / X URL</label>
        <input type="url" name="twitter_url" class="form-control" value="{{ old('twitter_url', $member->twitter_url) }}">
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label text-xs fw-bold">Biography / Career Summary</label>
      <textarea name="bio" rows="4" class="form-control">{{ old('bio', $member->bio) }}</textarea>
    </div>

    <div class="mb-3 d-flex align-items-center gap-3">
      <img src="{{ $member->image_url }}" alt="Portrait" class="rounded-circle border" style="width: 50px; height: 50px; object-fit: cover;">
      <span class="text-xs text-muted">Current Active Portrait Photo</span>
    </div>

    <div class="row g-3 mb-4">
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Replace with Local File</label>
        <input type="file" name="image_file" class="form-control form-control-sm" accept="image/*">
      </div>
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Or Direct Image URL</label>
        <input type="url" name="image_url" class="form-control form-control-sm" value="{{ old('image_url') }}" placeholder="https://...">
      </div>
    </div>

    <div class="row g-3 mb-4 align-items-center">
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Sort Order</label>
        <input type="number" name="order" class="form-control form-control-sm" value="{{ old('order', $member->order) }}">
      </div>
      <div class="col-md-6 pt-3">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" name="status" id="memberStatus" value="1" {{ old('status', $member->status) ? 'checked' : '' }}>
          <label class="form-check-label text-sm fw-bold" for="memberStatus">Active in Roster</label>
        </div>
      </div>
    </div>

    <button type="submit" class="hm-btn hm-btn-primary fw-bold">
      <i class="bi bi-check-circle me-1"></i> Update Profile
    </button>
  </form>
</div>
@endsection
