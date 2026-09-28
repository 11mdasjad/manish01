@extends('layouts.admin')

@section('title', 'Manage Portfolio Projects')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Portfolio & Landmark Projects</h2>
    <p class="text-muted text-sm mb-0">Showcase mega food parks, automated grain silos, and commercial plazas.</p>
  </div>
  <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm">
    <i class="bi bi-plus-circle me-1"></i> Add New Project
  </a>
</div>

{{-- Table --}}
<div class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light text-xs text-uppercase">
        <tr>
          <th style="width: 70px;">Visual</th>
          <th>Project Title</th>
          <th>Client & Sector</th>
          <th>Location</th>
          <th>Budget</th>
          <th>Status</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody class="text-sm">
        @forelse($projects as $proj)
          <tr>
            <td>
              <img src="{{ $proj->image_url }}" alt="{{ $proj->title }}" class="rounded border" style="width: 50px; height: 50px; object-fit: cover;">
            </td>
            <td>
              <strong class="d-block text-dark">{{ $proj->title }}</strong>
              <span class="text-xs text-muted">{{ Str::limit($proj->scope, 45) }}</span>
            </td>
            <td>
              <span class="fw-semibold text-dark d-block">{{ $proj->client_name }}</span>
              <span class="badge bg-light text-dark border">{{ $proj->sector }}</span>
            </td>
            <td>{{ $proj->location }}</td>
            <td class="text-warning fw-bold">{{ $proj->budget ?? '-' }}</td>
            <td>
              <span class="badge {{ $proj->status ? 'bg-success' : 'bg-secondary' }}">
                {{ $proj->status ? 'Active' : 'Draft' }}
              </span>
            </td>
            <td class="text-end">
              <a href="{{ route('projects.show', $proj->slug) }}" target="_blank" class="btn btn-sm btn-outline-secondary py-1 px-2" title="View Public Page">
                <i class="bi bi-eye"></i>
              </a>
              <a href="{{ route('admin.projects.edit', $proj->id) }}" class="btn btn-sm btn-outline-primary py-1 px-2" title="Edit Project">
                <i class="bi bi-pencil"></i>
              </a>
              <button type="button" class="btn btn-sm btn-outline-danger py-1 px-2" onclick="if(confirm('Delete project?')) { document.getElementById('delete-proj-{{ $proj->id }}').submit(); }">
                <i class="bi bi-trash"></i>
              </button>
              <form id="delete-proj-{{ $proj->id }}" action="{{ route('admin.projects.destroy', $proj->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="text-center py-4 text-muted">No projects recorded in portfolio.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
