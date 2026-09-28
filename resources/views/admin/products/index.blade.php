@extends('layouts.admin')

@section('title', 'Manage Products & Commodities')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Products & Commodities Catalog</h2>
    <p class="text-muted text-sm mb-0">Manage export grains, pulses, edible oils, and verified agricultural land parcels.</p>
  </div>
  <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">
    <i class="bi bi-plus-circle me-1"></i> Add New Product
  </a>
</div>

{{-- Filters --}}
<div class="card border-0 shadow-sm rounded-3 mb-4 p-3 bg-white">
  <form action="{{ route('admin.products.index') }}" method="GET" class="row g-2 align-items-center">
    <div class="col-md-5">
      <input type="text" name="search" class="form-control form-control-sm" placeholder="Search by name, SKU..." value="{{ request('search') }}">
    </div>
    <div class="col-md-3">
      <select name="category_id" class="form-select form-select-sm">
        <option value="">All Categories</option>
        @foreach($categories as $cat)
          <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-2">
      <select name="status" class="form-select form-select-sm">
        <option value="">All Statuses</option>
        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
      </select>
    </div>
    <div class="col-md-2 d-flex gap-2">
      <button type="submit" class="btn btn-sm btn-secondary w-100">Filter</button>
      @if(request()->hasAny(['search', 'category_id', 'status']))
        <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-secondary" title="Clear"><i class="bi bi-x"></i></a>
      @endif
    </div>
  </form>
</div>

{{-- Catalog Table --}}
<div class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light text-xs text-uppercase">
        <tr>
          <th style="width: 70px;">Image</th>
          <th>Product / Commodity</th>
          <th>Category</th>
          <th>Price Range</th>
          <th>Status</th>
          <th>Featured</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody class="text-sm">
        @forelse($products as $prod)
          <tr>
            <td>
              <img src="{{ $prod->image_url }}" alt="{{ $prod->name }}" class="rounded border" style="width: 50px; height: 50px; object-fit: cover;">
            </td>
            <td>
              <strong class="d-block text-dark">{{ $prod->name }}</strong>
              <span class="text-xs text-muted">{{ $prod->sku ?? 'No SKU' }}</span>
            </td>
            <td>
              <span class="badge bg-light text-dark border">{{ $prod->category->name ?? 'Unassigned' }}</span>
            </td>
            <td class="text-warning fw-semibold">{{ $prod->price_range ?? 'RFQ' }}</td>
            <td>
              <form action="{{ route('admin.products.toggle-status', $prod->id) }}" method="POST">
                @csrf
                <button type="submit" class="badge border-0 {{ $prod->status ? 'bg-success' : 'bg-secondary' }}" style="cursor: pointer;" title="Click to toggle status">
                  {{ $prod->status ? 'Active' : 'Inactive' }}
                </button>
              </form>
            </td>
            <td>
              @if($prod->is_featured)
                <span class="badge bg-warning text-dark"><i class="bi bi-star-fill text-xs"></i> Yes</span>
              @else
                <span class="text-xs text-muted">No</span>
              @endif
            </td>
            <td class="text-end">
              <a href="{{ route('products.show', $prod->slug) }}" target="_blank" class="btn btn-sm btn-outline-secondary py-1 px-2" title="View Public Page">
                <i class="bi bi-eye"></i>
              </a>
              <a href="{{ route('admin.products.edit', $prod->id) }}" class="btn btn-sm btn-outline-primary py-1 px-2" title="Edit Product">
                <i class="bi bi-pencil"></i>
              </a>
              <button type="button" class="btn btn-sm btn-outline-danger py-1 px-2" onclick="if(confirm('Are you sure you want to permanently delete this product?')) { document.getElementById('delete-product-{{ $prod->id }}').submit(); }" title="Delete Product">
                <i class="bi bi-trash"></i>
              </button>
              <form id="delete-product-{{ $prod->id }}" action="{{ route('admin.products.destroy', $prod->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="text-center py-5 text-muted">No products found matching query.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($products->hasPages())
    <div class="card-footer bg-white py-3">
      {{ $products->links('pagination::bootstrap-5') }}
    </div>
  @endif
</div>
@endsection
