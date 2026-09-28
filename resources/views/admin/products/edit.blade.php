@extends('layouts.admin')

@section('title', 'Edit Product: ' . $product->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Edit Product: {{ $product->name }}</h2>
    <p class="text-muted text-sm mb-0">Modify specifications, pricing, imagery, and SEO metadata.</p>
  </div>
  <div class="d-flex gap-2">
    <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="btn btn-outline-primary btn-sm">
      <i class="bi bi-eye me-1"></i> View Live
    </a>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm">
      <i class="bi bi-arrow-left me-1"></i> Back to Catalog
    </a>
  </div>
</div>

<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="row g-4">
    {{-- Left Main Column --}}
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Core Product Information</h5>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Product / Commodity Name <span class="text-danger">*</span></label>
          <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label text-xs fw-bold">Division Category</label>
            <select name="category_id" class="form-select">
              <option value="">Select Category</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label text-xs fw-bold">SKU / Item Identifier</label>
            <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku) }}">
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label text-xs fw-bold">Marketing Tagline</label>
            <input type="text" name="tagline" class="form-control" value="{{ old('tagline', $product->tagline) }}">
          </div>
          <div class="col-md-6">
            <label class="form-label text-xs fw-bold">Price Range / Quotation Metric</label>
            <input type="text" name="price_range" class="form-control" value="{{ old('price_range', $product->price_range) }}">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Short Executive Summary</label>
          <textarea name="short_description" rows="3" class="form-control">{{ old('short_description', $product->short_description) }}</textarea>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Full Detailed Description</label>
          <textarea name="description" rows="6" class="form-control">{{ old('description', $product->description) }}</textarea>
        </div>
      </div>

      {{-- Features & Specifications --}}
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Features & Specifications</h5>

        @php
          $featuresText = is_array($product->features) ? implode("\n", $product->features) : '';
          $specsJson = is_array($product->specifications) ? json_encode($product->specifications, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '';
        @endphp

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Key Bullet Features (One per line)</label>
          <textarea name="features_text" rows="4" class="form-control">{{ old('features_text', $featuresText) }}</textarea>
        </div>

        <div class="mb-0">
          <label class="form-label text-xs fw-bold">Specifications JSON (Key-Value map)</label>
          <textarea name="specifications_json" rows="4" class="form-control font-monospace text-xs">{{ old('specifications_json', $specsJson) }}</textarea>
        </div>
      </div>

      {{-- SEO Metadata --}}
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white">
        <h5 class="fw-bold mb-3 border-bottom pb-2">SEO Metadata</h5>
        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Meta Title</label>
          <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $product->meta_title) }}">
        </div>
        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Meta Description</label>
          <textarea name="meta_description" rows="2" class="form-control">{{ old('meta_description', $product->meta_description) }}</textarea>
        </div>
        <div class="mb-0">
          <label class="form-label text-xs fw-bold">Meta Keywords</label>
          <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords', $product->meta_keywords) }}">
        </div>
      </div>
    </div>

    {{-- Right Sidebar Column --}}
    <div class="col-lg-4">
      {{-- Image Preview & Upload --}}
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Featured Image</h5>
        
        <div class="mb-3 text-center">
          <img src="{{ $product->image_url }}" alt="Current Image" class="img-fluid rounded border mb-2" style="max-height: 180px;">
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

      {{-- Status & Visibility --}}
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Publication State</h5>
        
        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" name="status" id="productStatus" value="1" {{ old('status', $product->status) ? 'checked' : '' }}>
          <label class="form-check-label text-sm fw-bold" for="productStatus">Active on Public Website</label>
        </div>

        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" name="is_featured" id="productFeatured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
          <label class="form-check-label text-sm fw-bold" for="productFeatured">Promote on Homepage</label>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Display Sort Order</label>
          <input type="number" name="order" class="form-control form-control-sm" value="{{ old('order', $product->order) }}">
        </div>

        <button type="submit" class="hm-btn hm-btn-primary w-100 fw-bold">
          <i class="bi bi-check-circle me-1"></i> Update Product Record
        </button>
      </div>
    </div>
  </div>
</form>
@endsection
