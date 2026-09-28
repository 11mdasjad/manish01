@extends('layouts.admin')

@section('title', 'Add Portfolio Project')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Create Portfolio Project</h2>
    <p class="text-muted text-sm mb-0">Record a flagship industrial, commercial, or agricultural development.</p>
  </div>
  <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary btn-sm">
    <i class="bi bi-arrow-left me-1"></i> Back to Projects
  </a>
</div>

<form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Project Facts</h5>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Project Title <span class="text-danger">*</span></label>
          <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="e.g. Mega Food & Logistics Park" required>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label text-xs fw-bold">Client / Entity</label>
            <input type="text" name="client_name" class="form-control" value="{{ old('client_name') }}" placeholder="e.g. State Industrial Corporation">
          </div>
          <div class="col-md-6">
            <label class="form-label text-xs fw-bold">Location</label>
            <input type="text" name="location" class="form-control" value="{{ old('location') }}" placeholder="e.g. Khordha Corridor, Odisha">
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <label class="form-label text-xs fw-bold">Industry Sector</label>
            <input type="text" name="sector" class="form-control" value="{{ old('sector') }}" placeholder="e.g. Agro-Infrastructure">
          </div>
          <div class="col-md-4">
            <label class="form-label text-xs fw-bold">Outlay / Budget</label>
            <input type="text" name="budget" class="form-control" value="{{ old('budget') }}" placeholder="e.g. ₹185 Crores">
          </div>
          <div class="col-md-4">
            <label class="form-label text-xs fw-bold">Completion Date</label>
            <input type="date" name="completion_date" class="form-control" value="{{ old('completion_date') }}">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Project Scope Summary</label>
          <textarea name="scope" rows="3" class="form-control" placeholder="Acreage, tonnage capacities, and key deliverables...">{{ old('scope') }}</textarea>
        </div>
      </div>

      {{-- Case Study Narrative --}}
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Case Study Deep-Dive</h5>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Site / Technical Challenge</label>
          <textarea name="challenge" rows="3" class="form-control" placeholder="Ground challenges, high moisture subsoil, cyclone codes...">{{ old('challenge') }}</textarea>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Engineering Solution Deployed</label>
          <textarea name="solution" rows="3" class="form-control" placeholder="Stone column piling, laser screeding, BIM modeling...">{{ old('solution') }}</textarea>
        </div>

        <div class="mb-0">
          <label class="form-label text-xs fw-bold">Measured Results & Impact</label>
          <textarea name="results" rows="3" class="form-control" placeholder="Throughput gains, carbon reduction, job creation...">{{ old('results') }}</textarea>
        </div>
      </div>
    </div>

    {{-- Right Sidebar --}}
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Project Imagery</h5>
        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Upload Local File</label>
          <input type="file" name="featured_image_file" class="form-control form-control-sm" accept="image/*">
        </div>
        <div class="text-center text-xs text-muted my-2">OR</div>
        <div class="mb-0">
          <label class="form-label text-xs fw-bold">Image Web URL</label>
          <input type="url" name="featured_image_url" class="form-control form-control-sm" value="{{ old('featured_image_url') }}" placeholder="https://...">
        </div>
      </div>

      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Status & Showcase</h5>
        
        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" name="status" id="projStatus" checked value="1">
          <label class="form-check-label text-sm fw-bold" for="projStatus">Active in Portfolio</label>
        </div>

        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" name="is_featured" id="projFeatured" value="1">
          <label class="form-check-label text-sm fw-bold" for="projFeatured">Promote on Homepage</label>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Display Order</label>
          <input type="number" name="order" class="form-control form-control-sm" value="{{ old('order', 0) }}">
        </div>

        <button type="submit" class="hm-btn hm-btn-primary w-100 fw-bold">
          <i class="bi bi-save me-1"></i> Save Project Record
        </button>
      </div>
    </div>
  </div>
</form>
@endsection
