@extends('layouts.admin')

@section('title', 'Edit Media Asset: ' . $gallery->title)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Edit Media: {{ $gallery->title }}</h2>
    <p class="text-muted text-sm mb-0">Update title, caption, category, and image file.</p>
  </div>
  <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary btn-sm">
    <i class="bi bi-arrow-left me-1"></i> Back to Gallery
  </a>
</div>

<div class="card border-0 shadow-sm rounded-3 p-4 bg-white max-w-2xl">
  <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label text-xs fw-bold">Image Title <span class="text-danger">*</span></label>
      <input type="text" name="title" class="form-control" value="{{ old('title', $gallery->title) }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label text-xs fw-bold">Classification Category <span class="text-danger">*</span></label>
      <input type="text" name="category" class="form-control" value="{{ old('category', $gallery->category) }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label text-xs fw-bold">Short Caption / Description</label>
      <textarea name="description" rows="2" class="form-control">{{ old('description', $gallery->description) }}</textarea>
    </div>

    <div class="mb-3">
      <img src="{{ $gallery->image_url }}" alt="Preview" class="rounded border mb-2" style="max-height: 140px;">
      <span class="text-xs text-muted d-block">Current Active Media</span>
    </div>

    <div class="row g-3 mb-4">
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Replace with Local File</label>
        <input type="file" name="image_file" class="form-control form-control-sm" accept="image/*">
      </div>
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Or Direct Web Image URL</label>
        <input type="url" name="image_url" class="form-control form-control-sm" value="{{ old('image_url', $gallery->image) }}" placeholder="https://...">
      </div>
    </div>

    <div class="row g-3 mb-4 align-items-center">
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Display Order</label>
        <input type="number" name="order" class="form-control form-control-sm" value="{{ old('order', $gallery->order) }}">
      </div>
      <div class="col-md-6 pt-3">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" name="status" id="galStatus" value="1" {{ old('status', $gallery->status) ? 'checked' : '' }}>
          <label class="form-check-label text-sm fw-bold" for="galStatus">Active in Public Gallery</label>
        </div>
      </div>
    </div>

    <button type="submit" class="hm-btn hm-btn-primary fw-bold">
      <i class="bi bi-check-circle me-1"></i> Update Media Asset
    </button>
  </form>
</div>
@endsection
