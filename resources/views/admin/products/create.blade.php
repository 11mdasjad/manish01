@extends('layouts.admin')

@section('title', 'Add New Product')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Create Product Record</h2>
    <p class="text-muted text-sm mb-0">Add a new commodity, agro-produce, or land plot to the corporate catalog.</p>
  </div>
  <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm">
    <i class="bi bi-arrow-left me-1"></i> Back to Catalog
  </a>
</div>

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="row g-4">
    {{-- Left Main Column --}}
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Core Product Information</h5>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Product / Commodity Name <span class="text-danger">*</span></label>
          <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="e.g. Export-Grade Non-Basmati Rice" required>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label text-xs fw-bold">Division Category</label>
            <select name="category_id" class="form-select">
              <option value="">Select Category</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label text-xs fw-bold">SKU / Item Identifier</label>
            <input type="text" name="sku" class="form-control" value="{{ old('sku') }}" placeholder="e.g. HM-RICE-01">
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label text-xs fw-bold">Marketing Tagline</label>
            <input type="text" name="tagline" class="form-control" value="{{ old('tagline') }}" placeholder="e.g. 100% Sortex Cleaned, Low Moisture">
          </div>
          <div class="col-md-6">
            <label class="form-label text-xs fw-bold">Price Range / Quotation Metric</label>
            <input type="text" name="price_range" class="form-control" value="{{ old('price_range') }}" placeholder="e.g. $420 - $510 / Metric Ton">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Short Executive Summary</label>
          <textarea name="short_description" rows="3" class="form-control" placeholder="1-2 sentences summarizing origin, processing, and application...">{{ old('short_description') }}</textarea>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Full Detailed Description</label>
          <textarea name="description" rows="6" class="form-control" placeholder="Complete specifications, milling details, packing choices, and certifications...">{{ old('description') }}</textarea>
        </div>
      </div>

      {{-- Features & Specifications --}}
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Features & Specifications</h5>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Key Bullet Features (One per line)</label>
          <textarea name="features_text" rows="4" class="form-control" placeholder="Double-polished Sortex quality&#10;Moisture certified below 13.5%&#10;APEDA & Phytosanitary compliant">{{ old('features_text') }}</textarea>
        </div>

        <div class="mb-0">
          <label class="form-label text-xs fw-bold">Specifications JSON (Key-Value map)</label>
          <textarea name="specifications_json" rows="4" class="form-control font-monospace text-xs" placeholder='{"Origin": "Eastern India", "Moisture": "13.5% Max", "Broken": "5% Max"}'>{{ old('specifications_json') }}</textarea>
          <span class="text-xs text-muted">Enter valid JSON key-value pairs representing parameters and certified limits.</span>
        </div>
      </div>

      {{-- SEO Metadata --}}
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white">
        <h5 class="fw-bold mb-3 border-bottom pb-2">SEO Metadata</h5>
        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Meta Title</label>
          <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}" placeholder="Custom browser title tag">
        </div>
        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Meta Description</label>
          <textarea name="meta_description" rows="2" class="form-control" placeholder="Brief 150-160 character description for Google search...">{{ old('meta_description') }}</textarea>
        </div>
        <div class="mb-0">
          <label class="form-label text-xs fw-bold">Meta Keywords</label>
          <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords') }}" placeholder="Comma separated keywords">
        </div>
      </div>
    </div>

    {{-- Right Sidebar Column --}}
    <div class="col-lg-4">
      {{-- Image Upload --}}
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Featured Image</h5>
        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Upload Local Image File</label>
          <input type="file" name="featured_image_file" class="form-control form-control-sm" accept="image/*">
          <span class="text-xs text-muted">Supports WebP, PNG, JPG (Max 5MB)</span>
        </div>
        <div class="text-center text-xs text-muted my-2">OR</div>
        <div class="mb-0">
          <label class="form-label text-xs fw-bold">Direct Image Web URL</label>
          <input type="url" name="featured_image_url" class="form-control form-control-sm" value="{{ old('featured_image_url') }}" placeholder="https://images.unsplash.com/...">
        </div>
      </div>

      {{-- Status & Visibility --}}
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Publication State</h5>
        
        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" name="status" id="productStatus" checked value="1">
          <label class="form-check-label text-sm fw-bold" for="productStatus">Active on Public Website</label>
        </div>

        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" name="is_featured" id="productFeatured" value="1">
          <label class="form-check-label text-sm fw-bold" for="productFeatured">Promote on Homepage</label>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Display Sort Order</label>
          <input type="number" name="order" class="form-control form-control-sm" value="{{ old('order', 0) }}">
        </div>

        <button type="submit" class="hm-btn hm-btn-primary w-100 fw-bold">
          <i class="bi bi-save me-1"></i> Save Product Record
        </button>
      </div>
    </div>
  </div>
</form>
@endsection
