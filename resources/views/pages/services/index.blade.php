@extends('layouts.app')

@section('title', 'Real Estate & Land Advisory Services | Mais Agro House')
@section('meta_description', 'Legally verified property due diligence, free guided site visits, farmland advisory, and end-to-end registration in Bhubaneswar.')

@section('content')
<x-breadcrumb 
  title="Real Estate & Land Advisory Services" 
  subtitle="Comprehensive Real Estate Due Diligence, Layout Inspections, Free Site Visits & Registration Assistance"
  :items="['Services' => route('services.index')]" 
/>

<section class="hm-section bg-slate-50">
  <div class="container">
    {{-- Service Category Tabs --}}
    <div class="d-flex flex-wrap gap-2 justify-content-center mb-5">
      <a href="{{ route('services.index') }}" class="hm-btn {{ !request('category') ? 'hm-btn-primary' : 'hm-btn-outline' }} hm-btn-sm">
        All Services
      </a>
      @foreach($categories as $cat)
        <a href="{{ route('services.index', ['category' => $cat->slug]) }}" class="hm-btn {{ request('category') == $cat->slug ? 'hm-btn-primary' : 'hm-btn-outline' }} hm-btn-sm">
          {{ $cat->name }}
        </a>
      @endforeach
    </div>

    {{-- Services Grid --}}
    <div class="row g-4">
      @foreach($services as $serv)
        <div class="col-lg-6">
          <div class="hm-service-box text-dark">
            <div class="d-flex align-items-start gap-4">
              <div class="hm-service-icon flex-shrink-0">
                <i class="bi {{ $serv->icon ?? 'bi-gear-fill' }}"></i>
              </div>
              <div class="flex-grow-1">
                <span class="text-xs text-uppercase fw-bold text-warning">{{ $serv->category->name ?? 'Corporate Capability' }}</span>
                <h3 class="fw-bold h4 mt-1 mb-2">
                  <a href="{{ route('services.show', $serv->slug) }}" class="text-dark text-decoration-none">
                    {{ $serv->title }}
                  </a>
                </h3>
                
                @if($serv->tagline)
                  <p class="text-xs text-muted fst-italic mb-2">{{ $serv->tagline }}</p>
                @endif

                <p class="text-slate-600 text-sm mb-3">
                  {{ $serv->short_description }}
                </p>

                @if(!empty($serv->features) && is_array($serv->features))
                  <div class="row g-2 mb-4 text-xs text-slate-700">
                    @foreach(array_slice($serv->features, 0, 4) as $feat)
                      <div class="col-sm-6">
                        <i class="bi bi-check-circle-fill text-success me-1"></i> {{ $feat }}
                      </div>
                    @endforeach
                  </div>
                @endif

                <div class="d-flex align-items-center gap-3 pt-2 border-top">
                  <a href="{{ route('services.show', $serv->slug) }}" class="hm-btn hm-btn-primary hm-btn-sm">
                    View Full Scope <i class="bi bi-arrow-right"></i>
                  </a>
                  <button type="button" class="hm-btn hm-btn-outline hm-btn-sm" onclick="openEnquiryModal('service', '{{ $serv->id }}', '{{ addslashes($serv->title) }}')">
                    Inquire Service
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-5">
      {{ $services->links('pagination::bootstrap-5') }}
    </div>
  </div>
</section>
@endsection
