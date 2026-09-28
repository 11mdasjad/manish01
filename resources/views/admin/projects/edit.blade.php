@extends('layouts.admin')

@section('title', 'Edit Project: ' . $project->title)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Edit Project: {{ $project->title }}</h2>
    <p class="text-muted text-sm mb-0">Update case study details, challenge, solution, and imagery.</p>
  </div>
  <div class="d-flex gap-2">
    <a href="{{ route('projects.show', $project->slug) }}" target="_blank" class="btn btn-outline-primary btn-sm">
      <i class="bi bi-eye me-1"></i> View Live
    </a>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary btn-sm">
      <i class="bi bi-arrow-left me-1"></i> Back to Projects
    </a>
  </div>
</div>

<form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Project Facts</h5>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Project Title <span class="text-danger">*</span></label>
          <input type="text" name="title" class="form-control" value="{{ old('title', $project->title) }}" required>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label text-xs fw-bold">Client / Entity</label>
            <input type="text" name="client_name" class="form-control" value="{{ old('client_name', $project->client_name) }}">
          </div>
          <div class="col-md-6">
            <label class="form-label text-xs fw-bold">Location</label>
            <input type="text" name="location" class="form-control" value="{{ old('location', $project->location) }}">
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <label class="form-label text-xs fw-bold">Industry Sector</label>
            <input type="text" name="sector" class="form-control" value="{{ old('sector', $project->sector) }}">
          </div>
          <div class="col-md-4">
            <label class="form-label text-xs fw-bold">Outlay / Budget</label>
            <input type="text" name="budget" class="form-control" value="{{ old('budget', $project->budget) }}">
          </div>
          <div class="col-md-4">
            <label class="form-label text-xs fw-bold">Completion Date</label>
            <input type="date" name="completion_date" class="form-control" value="{{ old('completion_date', $project->completion_date ? $project->completion_date->format('Y-m-d') : '') }}">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Project Scope Summary</label>
          <textarea name="scope" rows="3" class="form-control">{{ old('scope', $project->scope) }}</textarea>
        </div>
      </div>

      {{-- Case Study Narrative --}}
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Case Study Deep-Dive</h5>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Site / Technical Challenge</label>
          <textarea name="challenge" rows="3" class="form-control">{{ old('challenge', $project->challenge) }}</textarea>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Engineering Solution Deployed</label>
          <textarea name="solution" rows="3" class="form-control">{{ old('solution', $project->solution) }}</textarea>
        </div>

        <div class="mb-0">
          <label class="form-label text-xs fw-bold">Measured Results & Impact</label>
          <textarea name="results" rows="3" class="form-control">{{ old('results', $project->results) }}</textarea>
        </div>
      </div>
    </div>

    {{-- Right Sidebar --}}
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Project Imagery</h5>
        <div class="mb-3 text-center">
          <img src="{{ $project->image_url }}" alt="Current Image" class="img-fluid rounded border mb-2" style="max-height: 180px;">
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
        <h5 class="fw-bold mb-3 border-bottom pb-2">Status & Showcase</h5>
        
        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" name="status" id="projStatus" value="1" {{ old('status', $project->status) ? 'checked' : '' }}>
          <label class="form-check-label text-sm fw-bold" for="projStatus">Active in Portfolio</label>
        </div>

        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" name="is_featured" id="projFeatured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}>
          <label class="form-check-label text-sm fw-bold" for="projFeatured">Promote on Homepage</label>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Display Order</label>
          <input type="number" name="order" class="form-control form-control-sm" value="{{ old('order', $project->order) }}">
        </div>

        <button type="submit" class="hm-btn hm-btn-primary w-100 fw-bold">
          <i class="bi bi-check-circle me-1"></i> Update Project
        </button>
      </div>
    </div>
  </div>
</form>
@endsection
