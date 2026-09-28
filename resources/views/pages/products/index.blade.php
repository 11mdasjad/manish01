@extends('layouts.app')

@section('title', 'Properties & Plots for Sale | Mais Agro House')
@section('meta_description', 'Browse legally verified residential plots, luxury apartments, and managed organic farmland parcels in Bhubaneswar.')

@section('content')
<x-breadcrumb 
  title="Properties & Land Parcels" 
  subtitle="Browse Verified Residential Plots, Luxury Apartments, and Managed Farmland Estates in Bhubaneswar"
  :items="['Properties' => route('products.index')]" 
/>

<section class="hm-section bg-slate-50">
  <div class="container">
    {{-- Search & Filter Controls --}}
    <div class="bg-white p-4 rounded-3 shadow-sm border mb-4">
      <form action="{{ route('products.index') }}" method="GET" class="row g-3 align-items-center">
        <div class="col-lg-5 col-md-6">
          <div class="input-group">
            <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
            <input type="text" name="search" class="form-control border-start-0" placeholder="Search apartments, residential plots, farmland, location..." value="{{ request('search') }}">
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <select name="category" class="form-select" onchange="this.form.submit()">
            <option value="">All Categories ({{ $categories->sum('products_count') }})</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                {{ $cat->name }} ({{ $cat->products_count }})
              </option>
            @endforeach
          </select>
        </div>

        <div class="col-lg-3 col-md-12 d-flex gap-2">
          <select name="sort" class="form-select" onchange="this.form.submit()">
            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest Additions</option>
            <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>Featured First</option>
            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
          </select>

          @if(request()->hasAny(['search', 'category', 'sort']))
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary" title="Clear Filters">
              <i class="bi bi-x-lg"></i>
            </a>
          @endif
        </div>
      </form>

      {{-- Category Quick Pills --}}
      <div class="d-flex flex-wrap gap-2 mt-3 pt-3 border-top">
        <a href="{{ route('products.index') }}" class="badge rounded-pill text-decoration-none px-3 py-2 {{ !request('category') ? 'bg-primary text-white' : 'bg-light text-dark border' }}">
          All Properties
        </a>
        @foreach($categories as $cat)
          <a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="badge rounded-pill text-decoration-none px-3 py-2 {{ request('category') == $cat->slug ? 'bg-primary text-white' : 'bg-light text-dark border' }}">
            {{ $cat->name }}
          </a>
        @endforeach
      </div>
    </div>

    {{-- Product Grid --}}
    @if($products->isEmpty())
      <div class="text-center py-5 bg-white rounded-3 border shadow-sm">
        <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
        <h4 class="fw-bold">No Properties Found</h4>
        <p class="text-muted">No property items matched your selected filters or search keywords.</p>
        <a href="{{ route('products.index') }}" class="hm-btn hm-btn-primary hm-btn-sm">Reset All Filters</a>
      </div>
    @else
      <div class="row g-4">
        @foreach($products as $prod)
          <div class="col-lg-4 col-md-6">
            <div class="hm-card">
              <div class="hm-card-img-wrap">
                <img src="{{ $prod->image_url }}" alt="{{ $prod->name }}" loading="lazy">
                @if($prod->category)
                  <span class="hm-card-badge">{{ $prod->category->name }}</span>
                @endif
              </div>
              <div class="hm-card-body">
                @if($prod->sku)
                  <span class="text-xs text-muted text-uppercase fw-bold mb-1 d-block">{{ $prod->sku }}</span>
                @endif

                <h3 class="hm-card-title">
                  <a href="{{ route('products.show', $prod->slug) }}">{{ $prod->name }}</a>
                </h3>

                <p class="hm-card-desc">{{ Str::limit($prod->short_description, 110) }}</p>

                @if(!empty($prod->specifications) && is_array($prod->specifications))
                  <div class="bg-light p-2 rounded mb-3 text-xs text-slate-600">
                    @php $firstTwo = array_slice($prod->specifications, 0, 2, true); @endphp
                    @foreach($firstTwo as $key => $val)
                      <div class="d-flex justify-content-between mb-1">
                        <span class="fw-semibold">{{ $key }}:</span>
                        <span class="text-end text-truncate ms-2" style="max-width: 60%;">{{ $val }}</span>
                      </div>
                    @endforeach
                  </div>
                @endif

                <div class="hm-card-footer">
                  <span class="fw-bold text-warning text-sm">{{ $prod->price_range ?? 'Pricing On Request' }}</span>
                  <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-outline-warning" onclick="openEnquiryModal('product', '{{ $prod->id }}', '{{ addslashes($prod->name) }}')">
                      Inquire
                    </button>
                    <a href="{{ route('products.show', $prod->slug) }}" class="btn btn-sm btn-primary">
                      View Property <i class="bi bi-chevron-right text-xs"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      {{-- Pagination --}}
      <div class="d-flex justify-content-center mt-5">
        {{ $products->links('pagination::bootstrap-5') }}
      </div>
    @endif
  </div>
</section>
@endsection
