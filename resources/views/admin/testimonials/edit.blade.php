@extends('layouts.admin')

@section('title', 'Edit Testimonial')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Edit Client Testimonial</h2>
    <p class="text-muted text-sm mb-0">Update quote, rating, client role, and display status.</p>
  </div>
  <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary btn-sm">
    <i class="bi bi-arrow-left me-1"></i> Back to Testimonials
  </a>
</div>

<div class="card border-0 shadow-sm rounded-3 p-4 bg-white max-w-2xl">
  <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row g-3 mb-3">
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Client Name <span class="text-danger">*</span></label>
        <input type="text" name="client_name" class="form-control" value="{{ old('client_name', $testimonial->client_name) }}" required>
      </div>
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Title / Designation</label>
        <input type="text" name="client_title" class="form-control" value="{{ old('client_title', $testimonial->client_title) }}">
      </div>
    </div>

    <div class="row g-3 mb-3">
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Company / Organization</label>
        <input type="text" name="company" class="form-control" value="{{ old('company', $testimonial->company) }}">
      </div>
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Star Rating <span class="text-danger">*</span></label>
        <select name="rating" class="form-select">
          <option value="5" {{ old('rating', $testimonial->rating) == 5 ? 'selected' : '' }}>5 Stars (Excellent)</option>
          <option value="4" {{ old('rating', $testimonial->rating) == 4 ? 'selected' : '' }}>4 Stars (Very Good)</option>
          <option value="3" {{ old('rating', $testimonial->rating) == 3 ? 'selected' : '' }}>3 Stars (Good)</option>
        </select>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label text-xs fw-bold">Feedback / Recommendation Quote <span class="text-danger">*</span></label>
      <textarea name="content" rows="4" class="form-control" required>{{ old('content', $testimonial->content) }}</textarea>
    </div>

    <div class="row g-3 mb-4">
      <div class="col-md-8">
        <label class="form-label text-xs fw-bold">Avatar / Portrait URL</label>
        <input type="url" name="avatar_url" class="form-control form-control-sm" value="{{ old('avatar_url', $testimonial->avatar) }}">
      </div>
      <div class="col-md-4">
        <label class="form-label text-xs fw-bold">Sort Order</label>
        <input type="number" name="order" class="form-control form-control-sm" value="{{ old('order', $testimonial->order) }}">
      </div>
    </div>

    <div class="form-check form-switch mb-4">
      <input class="form-check-input" type="checkbox" name="status" id="testStatus" value="1" {{ old('status', $testimonial->status) ? 'checked' : '' }}>
      <label class="form-check-label text-sm fw-bold" for="testStatus">Publish on Website</label>
    </div>

    <button type="submit" class="hm-btn hm-btn-primary fw-bold">
      <i class="bi bi-check-circle me-1"></i> Update Testimonial
    </button>
  </form>
</div>
@endsection
