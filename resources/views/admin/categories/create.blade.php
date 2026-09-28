@extends('layouts.admin')

@section('title', 'Add Category')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Create Taxonomy Category</h2>
    <p class="text-muted text-sm mb-0">Define a category for organizing products, services, or projects.</p>
  </div>
  <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm">
    <i class="bi bi-arrow-left me-1"></i> Back to Categories
  </a>
</div>

<div class="card border-0 shadow-sm rounded-3 p-4 bg-white max-w-2xl">
  <form action="{{ route('admin.categories.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label class="form-label text-xs fw-bold">Category Name <span class="text-danger">*</span></label>
      <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="e.g. Specialty Seeds & Pulses" required>
    </div>

    <div class="row g-3 mb-3">
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Classification Type <span class="text-danger">*</span></label>
        <select name="type" class="form-select" required>
          <option value="product" {{ old('type') == 'product' ? 'selected' : '' }}>Product Division</option>
          <option value="service" {{ old('type') == 'service' ? 'selected' : '' }}>Service Capability</option>
          <option value="project" {{ old('type') == 'project' ? 'selected' : '' }}>Project Sector</option>
          <option value="gallery" {{ old('type') == 'gallery' ? 'selected' : '' }}>Media Gallery</option>
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Sort Order</label>
        <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}">
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label text-xs fw-bold">Description / Scope Summary</label>
      <textarea name="description" rows="3" class="form-control" placeholder="Brief scope of items under this division...">{{ old('description') }}</textarea>
    </div>

    <div class="form-check form-switch mb-4">
      <input class="form-check-input" type="checkbox" name="is_active" id="catActive" checked value="1">
      <label class="form-check-label text-sm fw-bold" for="catActive">Active on Website</label>
    </div>

    <button type="submit" class="hm-btn hm-btn-primary fw-bold">
      <i class="bi bi-save me-1"></i> Save Category
    </button>
  </form>
</div>
@endsection
