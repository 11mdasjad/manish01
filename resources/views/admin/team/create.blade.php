@extends('layouts.admin')

@section('title', 'Add Team Member')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Create Team Member Profile</h2>
    <p class="text-muted text-sm mb-0">Add an executive director, senior engineer, or department head.</p>
  </div>
  <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary btn-sm">
    <i class="bi bi-arrow-left me-1"></i> Back to Team
  </a>
</div>

<div class="card border-0 shadow-sm rounded-3 p-4 bg-white max-w-2xl">
  <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row g-3 mb-3">
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Full Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="e.g. Manish Harshvardhan" required>
      </div>
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Designation / Title <span class="text-danger">*</span></label>
        <input type="text" name="designation" class="form-control" value="{{ old('designation') }}" placeholder="e.g. Chairman & Managing Director" required>
      </div>
    </div>

    <div class="row g-3 mb-3">
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Department / Division</label>
        <select name="department" class="form-select">
          <option value="Executive Board">Executive Board</option>
          <option value="Agro-Business & Real Estate">Agro-Business & Real Estate</option>
          <option value="Research & Quality Assurance">Research & Quality Assurance</option>
          <option value="Engineering & Construction">Engineering & Construction</option>
          <option value="Global Trade & Supply Chain">Global Trade & Supply Chain</option>
          <option value="Finance & Legal Affairs">Finance & Legal Affairs</option>
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Corporate Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="name@harshmais.com">
      </div>
    </div>

    <div class="row g-3 mb-3">
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">LinkedIn Profile URL</label>
        <input type="url" name="linkedin_url" class="form-control" value="{{ old('linkedin_url') }}" placeholder="https://linkedin.com/in/...">
      </div>
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Twitter / X URL</label>
        <input type="url" name="twitter_url" class="form-control" value="{{ old('twitter_url') }}" placeholder="https://twitter.com/...">
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label text-xs fw-bold">Biography / Career Summary</label>
      <textarea name="bio" rows="4" class="form-control" placeholder="Executive experience, past leadership credentials, and areas of expertise...">{{ old('bio') }}</textarea>
    </div>

    <div class="row g-3 mb-4">
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Upload Portrait Photo</label>
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
        <input type="number" name="order" class="form-control form-control-sm" value="{{ old('order', 0) }}">
      </div>
      <div class="col-md-6 pt-3">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" name="status" id="memberStatus" checked value="1">
          <label class="form-check-label text-sm fw-bold" for="memberStatus">Active in Roster</label>
        </div>
      </div>
    </div>

    <button type="submit" class="hm-btn hm-btn-primary fw-bold">
      <i class="bi bi-save me-1"></i> Save Profile
    </button>
  </form>
</div>
@endsection
