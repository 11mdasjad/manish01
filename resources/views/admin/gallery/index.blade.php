@extends('layouts.admin')

@section('title', 'Manage Media Gallery')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Corporate Media Gallery</h2>
    <p class="text-muted text-sm mb-0">Upload and curate on-site photographs of warehouses, farmlands, silos, and facilities.</p>
  </div>
  <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary btn-sm">
    <i class="bi bi-cloud-arrow-up me-1"></i> Upload Media
  </a>
</div>

<div class="row g-3">
  @forelse($items as $item)
    <div class="col-md-4 col-lg-3">
      <div class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white h-100">
        <div style="aspect-ratio: 4/3; overflow: hidden; position: relative;">
          <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-100 h-100 object-fit-cover">
          <span class="badge bg-dark bg-opacity-75 position-absolute top-0 start-0 m-2">{{ $item->category }}</span>
        </div>
        <div class="p-3 d-flex flex-column justify-content-between flex-grow-1">
          <div>
            <h6 class="fw-bold mb-1 text-dark">{{ $item->title }}</h6>
            <p class="text-xs text-muted mb-2">{{ Str::limit($item->description, 50) }}</p>
          </div>
          <div class="d-flex justify-content-between align-items-center pt-2 border-top">
            <span class="badge {{ $item->status ? 'bg-success' : 'bg-secondary' }} text-xs">
              {{ $item->status ? 'Visible' : 'Hidden' }}
            </span>
            <div class="d-flex gap-1">
              <a href="{{ route('admin.gallery.edit', $item->id) }}" class="btn btn-xs btn-outline-primary py-1 px-2" style="font-size: 0.75rem;">
                <i class="bi bi-pencil"></i>
              </a>
              <button type="button" class="btn btn-xs btn-outline-danger py-1 px-2" style="font-size: 0.75rem;" onclick="if(confirm('Delete media item?')) { document.getElementById('delete-gal-{{ $item->id }}').submit(); }">
                <i class="bi bi-trash"></i>
              </button>
              <form id="delete-gal-{{ $item->id }}" action="{{ route('admin.gallery.destroy', $item->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  @empty
    <div class="col-12 text-center py-5 bg-white rounded border">
      <i class="bi bi-images fs-1 text-muted d-block mb-2"></i>
      <p class="text-muted mb-0">No media items in the gallery catalog.</p>
    </div>
  @endforelse
</div>

@if($items->hasPages())
  <div class="d-flex justify-content-center mt-4">
    {{ $items->links('pagination::bootstrap-5') }}
  </div>
@endif
@endsection
