@extends('layouts.admin')

@section('title', 'Manage Corporate Services')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Corporate & Industrial Services</h2>
    <p class="text-muted text-sm mb-0">Manage turnkey EPC infrastructure, port-side logistics, and land advisory services.</p>
  </div>
  <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm">
    <i class="bi bi-plus-circle me-1"></i> Add New Service
  </a>
</div>

{{-- Filters --}}
<div class="card border-0 shadow-sm rounded-3 mb-4 p-3 bg-white">
  <form action="{{ route('admin.services.index') }}" method="GET" class="row g-2 align-items-center">
    <div class="col-md-6">
      <input type="text" name="search" class="form-control form-control-sm" placeholder="Search service title..." value="{{ request('search') }}">
    </div>
    <div class="col-md-4">
      <select name="category_id" class="form-select form-select-sm">
        <option value="">All Categories</option>
        @foreach($categories as $cat)
          <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-sm btn-secondary w-100">Filter</button>
    </div>
  </form>
</div>

{{-- Services Table --}}
<div class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light text-xs text-uppercase">
        <tr>
          <th style="width: 50px;">Icon</th>
          <th>Service Title</th>
          <th>Division Category</th>
          <th>Status</th>
          <th>Homepage</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody class="text-sm">
        @forelse($services as $serv)
          <tr>
            <td>
              <div class="p-2 bg-light rounded text-center text-primary fs-5 border" style="width: 42px; height: 42px; display: flex; align-items: center; justify-content: center;">
                <i class="bi {{ $serv->icon ?? 'bi-gear-fill' }}"></i>
              </div>
            </td>
            <td>
              <strong class="d-block text-dark">{{ $serv->title }}</strong>
              <span class="text-xs text-muted">{{ Str::limit($serv->tagline, 45) }}</span>
            </td>
            <td>
              <span class="badge bg-light text-dark border">{{ $serv->category->name ?? 'Corporate' }}</span>
            </td>
            <td>
              <form action="{{ route('admin.services.toggle-status', $serv->id) }}" method="POST">
                @csrf
                <button type="submit" class="badge border-0 {{ $serv->status ? 'bg-success' : 'bg-secondary' }}" style="cursor: pointer;">
                  {{ $serv->status ? 'Active' : 'Inactive' }}
                </button>
              </form>
            </td>
            <td>
              @if($serv->is_featured)
                <span class="badge bg-warning text-dark">Promoted</span>
              @else
                <span class="text-xs text-muted">Standard</span>
              @endif
            </td>
            <td class="text-end">
              <a href="{{ route('services.show', $serv->slug) }}" target="_blank" class="btn btn-sm btn-outline-secondary py-1 px-2" title="View Public Page">
                <i class="bi bi-eye"></i>
              </a>
              <a href="{{ route('admin.services.edit', $serv->id) }}" class="btn btn-sm btn-outline-primary py-1 px-2" title="Edit Service">
                <i class="bi bi-pencil"></i>
              </a>
              <button type="button" class="btn btn-sm btn-outline-danger py-1 px-2" onclick="if(confirm('Are you sure you want to delete this service?')) { document.getElementById('delete-service-{{ $serv->id }}').submit(); }" title="Delete Service">
                <i class="bi bi-trash"></i>
              </button>
              <form id="delete-service-{{ $serv->id }}" action="{{ route('admin.services.destroy', $serv->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center py-5 text-muted">No corporate services recorded.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($services->hasPages())
    <div class="card-footer bg-white py-3">
      {{ $services->links('pagination::bootstrap-5') }}
    </div>
  @endif
</div>
@endsection
