@extends('layouts.admin')

@section('title', 'Add Partner Client')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Add Partner Client</h2>
    <p class="text-muted text-sm mb-0">Record an institutional client or corporate partner.</p>
  </div>
  <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-secondary btn-sm">
    <i class="bi bi-arrow-left me-1"></i> Back to Clients
  </a>
</div>

<div class="card border-0 shadow-sm rounded-3 p-4 bg-white max-w-2xl">
  <form action="{{ route('admin.clients.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label class="form-label text-xs fw-bold">Company / Entity Name <span class="text-danger">*</span></label>
      <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="e.g. Tata Steel Logistics" required>
    </div>

    <div class="row g-3 mb-3">
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Industry Sector</label>
        <input type="text" name="industry" class="form-control" value="{{ old('industry') }}" placeholder="e.g. Heavy Logistics & Steel">
      </div>
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Website URL</label>
        <input type="url" name="website_url" class="form-control" value="{{ old('website_url') }}" placeholder="https://...">
      </div>
    </div>

    <div class="row g-3 mb-4 align-items-center">
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Display Order</label>
        <input type="number" name="order" class="form-control form-control-sm" value="{{ old('order', 0) }}">
      </div>
      <div class="col-md-6 pt-3">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" name="status" id="clientStatus" checked value="1">
          <label class="form-check-label text-sm fw-bold" for="clientStatus">Active Partner</label>
        </div>
      </div>
    </div>

    <button type="submit" class="hm-btn hm-btn-primary fw-bold">
      <i class="bi bi-save me-1"></i> Save Partner Record
    </button>
  </form>
</div>
@endsection
