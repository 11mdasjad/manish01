@extends('layouts.app')

@section('title', 'Property & Project Gallery | Mais Agro House')
@section('meta_description', 'High-definition photo gallery of luxury residential apartments, gated plotted enclaves, and organic farmland estates in Bhubaneswar.')

@section('content')
<x-breadcrumb 
  title="Media & Property Gallery" 
  subtitle="High-Resolution Visual Documentation of Our Apartments, Gated Plotted Communities & Farmland Estates in Bhubaneswar"
  :items="['Gallery' => route('gallery.index')]" 
/>

<section class="hm-section bg-slate-50">
  <div class="container">
    {{-- Category Filters --}}
    <div class="d-flex flex-wrap gap-2 justify-content-center mb-5">
      <a href="{{ route('gallery.index') }}" class="hm-btn {{ !request('category') ? 'hm-btn-primary' : 'hm-btn-outline' }} hm-btn-sm">
        All Media ({{ $items->total() }})
      </a>
      @foreach($categories as $cat)
        <a href="{{ route('gallery.index', ['category' => $cat]) }}" class="hm-btn {{ request('category') == $cat ? 'hm-btn-primary' : 'hm-btn-outline' }} hm-btn-sm">
          {{ $cat }}
        </a>
      @endforeach
    </div>

    {{-- Gallery Grid --}}
    <div class="row g-4">
      @foreach($items as $item)
        <div class="col-lg-4 col-md-6">
          <div class="hm-card position-relative overflow-hidden group">
            <div class="hm-card-img-wrap" style="aspect-ratio: 4/3;">
              <img src="{{ $item->image_url }}" alt="{{ $item->title }}" loading="lazy">
              <span class="hm-card-badge">{{ $item->category }}</span>
              
              {{-- Hover Overlay & Lightbox Button --}}
              <div class="position-absolute inset-0 bg-dark bg-opacity-50 d-flex flex-column justify-content-end p-4 text-white opacity-0 hover-opacity-100 transition" style="transition: opacity 0.3s ease;">
                <h5 class="fw-bold mb-1 text-white">{{ $item->title }}</h5>
                <p class="text-xs text-white-50 mb-3">{{ $item->description }}</p>
                <a href="{{ $item->image_url }}" class="hm-lightbox-trigger hm-btn hm-btn-gold hm-btn-sm align-self-start" data-image="{{ $item->image_url }}">
                  <i class="bi bi-arrows-fullscreen"></i> View High-Res
                </a>
              </div>
            </div>
            <div class="p-3 bg-white">
              <h5 class="fw-bold text-dark mb-1 h6">{{ $item->title }}</h5>
              <span class="text-xs text-muted">{{ $item->description }}</span>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-5">
      {{ $items->links('pagination::bootstrap-5') }}
    </div>
  </div>
</section>
@endsection
