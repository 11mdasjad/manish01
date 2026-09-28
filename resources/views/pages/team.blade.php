@extends('layouts.app')

@section('title', 'Corporate Leadership & Board of Directors | HarshMais Global')
@section('meta_description', 'Meet the executive leadership and board of directors guiding HarshMais Global Enterprises across infrastructure and agro-commodities.')

@section('content')
<x-breadcrumb 
  title="Our Leadership & Governance" 
  subtitle="Experienced Executive Board Guiding Multidisciplinary Excellence & Global Trust"
  :items="['Our Team' => route('team.index')]" 
/>

<section class="hm-section bg-slate-50">
  <div class="container">
    {{-- Executive Board --}}
    <div class="text-center mb-5">
      <span class="hm-badge"><i class="bi bi-person-badge"></i> EXECUTIVE DIRECTORS</span>
      <h2 class="hm-section-title">The Governing Board</h2>
      <p class="hm-section-subtitle">
        Stewarding group vision, strategic capital allocation, and rigorous compliance across all operating entities.
      </p>
    </div>

    <div class="row g-4 mb-5">
      @foreach($executiveBoard as $exec)
        <div class="col-lg-4 col-md-6">
          <div class="hm-card">
            <div class="hm-card-img-wrap" style="aspect-ratio: 1/1;">
              <img src="{{ $exec->image_url }}" alt="{{ $exec->name }}" loading="lazy">
              <span class="hm-card-badge">{{ $exec->department }}</span>
            </div>
            <div class="hm-card-body">
              <h3 class="fw-bold h4 mb-1">{{ $exec->name }}</h3>
              <span class="text-xs text-warning fw-bold text-uppercase d-block mb-3">{{ $exec->designation }}</span>
              <p class="text-slate-600 text-sm mb-4" style="line-height: 1.7;">
                {{ $exec->bio }}
              </p>
              
              <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                @if($exec->email)
                  <a href="mailto:{{ $exec->email }}" class="text-xs text-muted text-decoration-none">
                    <i class="bi bi-envelope me-1"></i> {{ $exec->email }}
                  </a>
                @endif
                @if($exec->linkedin_url)
                  <a href="{{ $exec->linkedin_url }}" target="_blank" class="text-primary fs-5" title="LinkedIn Profile">
                    <i class="bi bi-linkedin"></i>
                  </a>
                @endif
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    {{-- Senior Management & Operational Heads --}}
    @if($otherMembers->isNotEmpty())
      <div class="text-center mb-5 pt-4 border-top">
        <span class="hm-badge hm-badge-blue"><i class="bi bi-people-fill"></i> OPERATIONAL HEADS</span>
        <h2 class="hm-section-title">Senior Technical & Division Leadership</h2>
      </div>

      <div class="row g-4">
        @foreach($otherMembers as $mem)
          <div class="col-lg-4 col-md-6">
            <div class="hm-card">
              <div class="hm-card-img-wrap" style="aspect-ratio: 1/1;">
                <img src="{{ $mem->image_url }}" alt="{{ $mem->name }}" loading="lazy">
                <span class="hm-card-badge">{{ $mem->department }}</span>
              </div>
              <div class="hm-card-body">
                <h4 class="fw-bold mb-1">{{ $mem->name }}</h4>
                <span class="text-xs text-warning fw-bold text-uppercase d-block mb-3">{{ $mem->designation }}</span>
                <p class="text-slate-600 text-sm mb-4">
                  {{ $mem->bio }}
                </p>
                <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                  @if($mem->email)
                    <a href="mailto:{{ $mem->email }}" class="text-xs text-muted text-decoration-none">
                      <i class="bi bi-envelope me-1"></i> {{ $mem->email }}
                    </a>
                  @endif
                  @if($mem->linkedin_url)
                    <a href="{{ $mem->linkedin_url }}" target="_blank" class="text-primary fs-5">
                      <i class="bi bi-linkedin"></i>
                    </a>
                  @endif
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>
@endsection
