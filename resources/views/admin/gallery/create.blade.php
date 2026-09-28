@extends('layouts.admin')

@section('title', 'Upload Media Item')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Upload Gallery Asset</h2>
    <p class="text-muted text-sm mb-0">Add photography of facilities, silos, estates, and corporate milestones.</p>
  </div>
  <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary btn-sm">
    <i class="bi bi-arrow-left me-1"></i> Back to Gallery
  </a>
</div>

<div class="card border-0 shadow-sm rounded-3 p-4 bg-white max-w-2xl">
  <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
      <label class="form-label text-xs fw-bold">Image Title <span class="text-danger">*</span></label>
      <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="e.g. Laser-Guided Grain Sorter" required>
    </div>

    <div class="mb-3">
      <label class="form-label text-xs fw-bold">Classification Category <span class="text-danger">*</span></label>
      <input type="text" name="category" class="form-control" value="{{ old('category', 'Infrastructure') }}" placeholder="e.g. Infrastructure / Agro Processing / Real Estate / Renewables" required>
    </div>

    <div class="mb-3">
      <label class="form-label text-xs fw-bold">Short Caption / Description</label>
      <textarea name="description" rows="2" class="form-control" placeholder="Context regarding facility location, capacity, or specifications...">{{ old('description') }}</textarea>
    </div>

    <div class="row g-3 mb-4">
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Upload Local File</label>
        <input type="file" name="image_file" class="form-control form-control-sm" accept="image/*">
      </div>
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Or Direct Web Image URL</label>
        <input type="url" name="image_url" class="form-control form-control-sm" value="{{ old('image_url') }}" placeholder="https://...">
      </div>
    </div>

    <div class="row g-3 mb-4 align-items-center">
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Display Order</label>
        <input type="number" name="order" class="form-control form-control-sm" value="{{ old('order', 0) }}">
      </div>
      <div class="col-md-6 pt-3">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" name="status" id="galStatus" checked value="1">
          <label class="form-check-label text-sm fw-bold" for="galStatus">Active in Public Gallery</label>
        </div>
      </div>
    </div>

    <button type="submit" class="hm-btn hm-btn-primary fw-bold">
      <i class="bi bi-cloud-arrow-up me-1"></i> Upload Asset
    </button>
  </form>
</div>
@endsection
