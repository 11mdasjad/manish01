@extends('layouts.admin')

@section('title', 'Edit Category: ' . $category->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Edit Category: {{ $category->name }}</h2>
    <p class="text-muted text-sm mb-0">Modify classification type, description, and display order.</p>
  </div>
  <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm">
    <i class="bi bi-arrow-left me-1"></i> Back to Categories
  </a>
</div>

<div class="card border-0 shadow-sm rounded-3 p-4 bg-white max-w-2xl">
  <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label text-xs fw-bold">Category Name <span class="text-danger">*</span></label>
      <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
    </div>

    <div class="row g-3 mb-3">
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Classification Type <span class="text-danger">*</span></label>
        <select name="type" class="form-select" required>
          <option value="product" {{ old('type', $category->type) == 'product' ? 'selected' : '' }}>Product Division</option>
          <option value="service" {{ old('type', $category->type) == 'service' ? 'selected' : '' }}>Service Capability</option>
          <option value="project" {{ old('type', $category->type) == 'project' ? 'selected' : '' }}>Project Sector</option>
          <option value="gallery" {{ old('type', $category->type) == 'gallery' ? 'selected' : '' }}>Media Gallery</option>
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Sort Order</label>
        <input type="number" name="order" class="form-control" value="{{ old('order', $category->order) }}">
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label text-xs fw-bold">Cover / Thumbnail Image</label>
      @if($category->image)
        <div class="mb-2 d-flex align-items-center gap-2">
          <img src="{{ $category->image_url }}" alt="Preview" class="rounded border object-fit-cover" style="width: 60px; height: 60px;">
          <span class="text-xs text-muted font-monospace text-truncate" style="max-width: 300px;">{{ $category->image }}</span>
        </div>
      @endif
      <div class="row g-2">
        <div class="col-md-6">
          <label class="form-label text-xs text-muted">Upload New Image File</label>
          <input type="file" name="image_file" class="form-control" accept="image/*">
        </div>
        <div class="col-md-6">
          <label class="form-label text-xs text-muted">Or Image URL / Path</label>
          <input type="text" name="image" class="form-control" value="{{ old('image', $category->image) }}" placeholder="e.g. /images/products/seeds.jpg">
        </div>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label text-xs fw-bold">Description / Scope Summary</label>
      <textarea name="description" rows="3" class="form-control">{{ old('description', $category->description) }}</textarea>
    </div>

    <div class="form-check form-switch mb-4">
      <input class="form-check-input" type="checkbox" name="is_active" id="catActive" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
      <label class="form-check-label text-sm fw-bold" for="catActive">Active on Website</label>
    </div>

    <button type="submit" class="hm-btn hm-btn-primary fw-bold">
      <i class="bi bi-check-circle me-1"></i> Update Category
    </button>
  </form>
</div>
@endsection
