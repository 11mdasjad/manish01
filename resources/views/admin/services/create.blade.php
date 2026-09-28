@extends('layouts.admin')

@section('title', 'Add Corporate Service')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Create Corporate Service</h2>
    <p class="text-muted text-sm mb-0">Add turnkey EPC, cold chain, or land verification capability.</p>
  </div>
  <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary btn-sm">
    <i class="bi bi-arrow-left me-1"></i> Back to Services
  </a>
</div>

<form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Service Details</h5>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Service Title <span class="text-danger">*</span></label>
          <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="e.g. Turnkey Industrial Warehousing & Infrastructure EPC" required>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label text-xs fw-bold">Category</label>
            <select name="category_id" class="form-select">
              <option value="">Select Category</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label text-xs fw-bold">Bootstrap Icon Class</label>
            <input type="text" name="icon" class="form-control" value="{{ old('icon', 'bi-gear-wide-connected') }}" placeholder="e.g. bi-building-gear">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Marketing Tagline</label>
          <input type="text" name="tagline" class="form-control" value="{{ old('tagline') }}" placeholder="e.g. High-Speed PEB Construction & Precision Laser Screeding">
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Short Summary</label>
          <textarea name="short_description" rows="3" class="form-control" placeholder="1-2 sentences summarizing service scope...">{{ old('short_description') }}</textarea>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Comprehensive Scope Narrative</label>
          <textarea name="description" rows="6" class="form-control" placeholder="Detailed engineering methodology, equipment deployed, and certifications...">{{ old('description') }}</textarea>
        </div>
      </div>

      {{-- Features & Benefits --}}
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Technical Capabilities & Client Benefits</h5>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Scope Capabilities (One per line)</label>
          <textarea name="features_text" rows="4" class="form-control" placeholder="Clear-span PEB frames up to 60m&#10;FM2 special floor flatness&#10;NFPA compliant fire network">{{ old('features_text') }}</textarea>
        </div>

        <div class="mb-0">
          <label class="form-label text-xs fw-bold">Client Benefits (One per line)</label>
          <textarea name="benefits_text" rows="4" class="form-control" placeholder="40% faster commissioning than civil masonry&#10;Cyclone & seismic engineered rigidity&#10;Single-point EPC accountability">{{ old('benefits_text') }}</textarea>
        </div>
      </div>

      {{-- SEO Metadata --}}
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white">
        <h5 class="fw-bold mb-3 border-bottom pb-2">SEO Metadata</h5>
        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Meta Title</label>
          <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}">
        </div>
        <div class="mb-0">
          <label class="form-label text-xs fw-bold">Meta Description</label>
          <textarea name="meta_description" rows="2" class="form-control">{{ old('meta_description') }}</textarea>
        </div>
      </div>
    </div>

    {{-- Right Sidebar --}}
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Visual Asset</h5>
        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Upload Image File</label>
          <input type="file" name="featured_image_file" class="form-control form-control-sm" accept="image/*">
        </div>
        <div class="text-center text-xs text-muted my-2">OR</div>
        <div class="mb-0">
          <label class="form-label text-xs fw-bold">Image Web URL</label>
          <input type="url" name="featured_image_url" class="form-control form-control-sm" value="{{ old('featured_image_url') }}" placeholder="https://...">
        </div>
      </div>

      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Publication & State</h5>
        
        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" name="status" id="serviceStatus" checked value="1">
          <label class="form-check-label text-sm fw-bold" for="serviceStatus">Active on Website</label>
        </div>

        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" name="is_featured" id="serviceFeatured" value="1">
          <label class="form-check-label text-sm fw-bold" for="serviceFeatured">Feature on Homepage</label>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Display Order</label>
          <input type="number" name="order" class="form-control form-control-sm" value="{{ old('order', 0) }}">
        </div>

        <button type="submit" class="hm-btn hm-btn-primary w-100 fw-bold">
          <i class="bi bi-save me-1"></i> Save Service Record
        </button>
      </div>
    </div>
  </div>
</form>
@endsection
