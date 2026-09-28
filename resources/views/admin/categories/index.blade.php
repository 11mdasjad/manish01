@extends('layouts.admin')

@section('title', 'Manage Taxonomy Categories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Taxonomy Categories</h2>
    <p class="text-muted text-sm mb-0">Organize products, services, projects, and media under structured divisions.</p>
  </div>
  <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">
    <i class="bi bi-plus-circle me-1"></i> Add Category
  </a>
</div>

{{-- Category Type Tabs --}}
<div class="mb-4 d-flex gap-2">
  <a href="{{ route('admin.categories.index') }}" class="btn btn-sm {{ !request('type') ? 'btn-dark' : 'btn-outline-secondary' }}">All Types</a>
  <a href="{{ route('admin.categories.index', ['type' => 'product']) }}" class="btn btn-sm {{ request('type') == 'product' ? 'btn-dark' : 'btn-outline-secondary' }}">Products</a>
  <a href="{{ route('admin.categories.index', ['type' => 'service']) }}" class="btn btn-sm {{ request('type') == 'service' ? 'btn-dark' : 'btn-outline-secondary' }}">Services</a>
  <a href="{{ route('admin.categories.index', ['type' => 'project']) }}" class="btn btn-sm {{ request('type') == 'project' ? 'btn-dark' : 'btn-outline-secondary' }}">Projects</a>
</div>

{{-- Table --}}
<div class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light text-xs text-uppercase">
        <tr>
          <th>Category Name</th>
          <th>Type</th>
          <th>Slug</th>
          <th>Items Count</th>
          <th>Sort Order</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody class="text-sm">
        @forelse($categories as $cat)
          <tr>
            <td>
              <strong class="text-dark">{{ $cat->name }}</strong>
              @if($cat->description)
                <span class="text-xs text-muted d-block">{{ Str::limit($cat->description, 50) }}</span>
              @endif
            </td>
            <td>
              <span class="badge bg-primary text-uppercase">{{ $cat->type }}</span>
            </td>
            <td><code>{{ $cat->slug }}</code></td>
            <td>
              @if($cat->type === 'product')
                <span class="badge bg-light text-dark border">{{ $cat->products_count }} products</span>
              @elseif($cat->type === 'service')
                <span class="badge bg-light text-dark border">{{ $cat->services_count }} services</span>
              @elseif($cat->type === 'project')
                <span class="badge bg-light text-dark border">{{ $cat->projects_count }} projects</span>
              @else
                -
              @endif
            </td>
            <td>{{ $cat->order }}</td>
            <td class="text-end">
              <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn btn-sm btn-outline-primary py-1 px-2">
                <i class="bi bi-pencil"></i>
              </a>
              <button type="button" class="btn btn-sm btn-outline-danger py-1 px-2" onclick="if(confirm('Delete category? Associated items will be unlinked.')) { document.getElementById('delete-cat-{{ $cat->id }}').submit(); }">
                <i class="bi bi-trash"></i>
              </button>
              <form id="delete-cat-{{ $cat->id }}" action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center py-4 text-muted">No taxonomy categories recorded.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
