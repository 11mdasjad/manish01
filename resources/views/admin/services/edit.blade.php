@extends('layouts.admin')

@section('title', 'Edit Service: ' . $service->title)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Edit Service: {{ $service->title }}</h2>
    <p class="text-muted text-sm mb-0">Update technical capabilities, benefits, and media visuals.</p>
  </div>
  <div class="d-flex gap-2">
    <a href="{{ route('services.show', $service->slug) }}" target="_blank" class="btn btn-outline-primary btn-sm">
      <i class="bi bi-eye me-1"></i> View Live
    </a>
    <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary btn-sm">
      <i class="bi bi-arrow-left me-1"></i> Back to Services
    </a>
  </div>
</div>

<form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Service Details</h5>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Service Title <span class="text-danger">*</span></label>
          <input type="text" name="title" class="form-control" value="{{ old('title', $service->title) }}" required>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label text-xs fw-bold">Category</label>
            <select name="category_id" class="form-select">
              <option value="">Select Category</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id', $service->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label text-xs fw-bold">Bootstrap Icon Class</label>
            <input type="text" name="icon" class="form-control" value="{{ old('icon', $service->icon) }}">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Marketing Tagline</label>
          <input type="text" name="tagline" class="form-control" value="{{ old('tagline', $service->tagline) }}">
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Short Summary</label>
          <textarea name="short_description" rows="3" class="form-control">{{ old('short_description', $service->short_description) }}</textarea>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Comprehensive Scope Narrative</label>
          <textarea name="description" rows="6" class="form-control">{{ old('description', $service->description) }}</textarea>
        </div>
      </div>

      {{-- Features & Benefits --}}
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Technical Capabilities & Client Benefits</h5>

        @php
          $featText = is_array($service->features) ? implode("\n", $service->features) : '';
          $benText = is_array($service->benefits) ? implode("\n", $service->benefits) : '';
        @endphp

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Scope Capabilities (One per line)</label>
          <textarea name="features_text" rows="4" class="form-control">{{ old('features_text', $featText) }}</textarea>
        </div>

        <div class="mb-0">
          <label class="form-label text-xs fw-bold">Client Benefits (One per line)</label>
          <textarea name="benefits_text" rows="4" class="form-control">{{ old('benefits_text', $benText) }}</textarea>
        </div>
      </div>

      {{-- SEO Metadata --}}
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white">
        <h5 class="fw-bold mb-3 border-bottom pb-2">SEO Metadata</h5>
        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Meta Title</label>
          <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $service->meta_title) }}">
        </div>
        <div class="mb-0">
          <label class="form-label text-xs fw-bold">Meta Description</label>
          <textarea name="meta_description" rows="2" class="form-control">{{ old('meta_description', $service->meta_description) }}</textarea>
        </div>
      </div>
    </div>

    {{-- Right Sidebar --}}
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Featured Image</h5>
        <div class="mb-3 text-center">
          <img src="{{ $service->image_url }}" alt="Current Image" class="img-fluid rounded border mb-2" style="max-height: 180px;">
          <span class="text-xs text-muted d-block">Current Active Visual</span>
        </div>
        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Replace with Local File</label>
          <input type="file" name="featured_image_file" class="form-control form-control-sm" accept="image/*">
        </div>
        <div class="text-center text-xs text-muted my-2">OR</div>
        <div class="mb-0">
          <label class="form-label text-xs fw-bold">Direct Image Web URL</label>
          <input type="url" name="featured_image_url" class="form-control form-control-sm" value="{{ old('featured_image_url') }}" placeholder="https://...">
        </div>
      </div>

      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Publication & State</h5>
        
        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" name="status" id="serviceStatus" value="1" {{ old('status', $service->status) ? 'checked' : '' }}>
          <label class="form-check-label text-sm fw-bold" for="serviceStatus">Active on Website</label>
        </div>

        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" name="is_featured" id="serviceFeatured" value="1" {{ old('is_featured', $service->is_featured) ? 'checked' : '' }}>
          <label class="form-check-label text-sm fw-bold" for="serviceFeatured">Feature on Homepage</label>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Display Order</label>
          <input type="number" name="order" class="form-control form-control-sm" value="{{ old('order', $service->order) }}">
        </div>

        <button type="submit" class="hm-btn hm-btn-primary w-100 fw-bold">
          <i class="bi bi-check-circle me-1"></i> Update Service Record
        </button>
      </div>
    </div>
  </div>
</form>
@endsection
