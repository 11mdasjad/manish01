@extends('layouts.admin')

@section('title', 'Edit Client: ' . $client->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Edit Client: {{ $client->name }}</h2>
    <p class="text-muted text-sm mb-0">Update company name, industry, and status.</p>
  </div>
  <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-secondary btn-sm">
    <i class="bi bi-arrow-left me-1"></i> Back to Clients
  </a>
</div>

<div class="card border-0 shadow-sm rounded-3 p-4 bg-white max-w-2xl">
  <form action="{{ route('admin.clients.update', $client->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label text-xs fw-bold">Company / Entity Name <span class="text-danger">*</span></label>
      <input type="text" name="name" class="form-control" value="{{ old('name', $client->name) }}" required>
    </div>

    <div class="row g-3 mb-3">
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Industry Sector</label>
        <input type="text" name="industry" class="form-control" value="{{ old('industry', $client->industry) }}">
      </div>
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Website URL</label>
        <input type="url" name="website_url" class="form-control" value="{{ old('website_url', $client->website_url) }}">
      </div>
    </div>

    <div class="row g-3 mb-4 align-items-center">
      <div class="col-md-6">
        <label class="form-label text-xs fw-bold">Display Order</label>
        <input type="number" name="order" class="form-control form-control-sm" value="{{ old('order', $client->order) }}">
      </div>
      <div class="col-md-6 pt-3">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" name="status" id="clientStatus" value="1" {{ old('status', $client->status) ? 'checked' : '' }}>
          <label class="form-check-label text-sm fw-bold" for="clientStatus">Active Partner</label>
        </div>
      </div>
    </div>

    <button type="submit" class="hm-btn hm-btn-primary fw-bold">
      <i class="bi bi-check-circle me-1"></i> Update Record
    </button>
  </form>
</div>
@endsection
