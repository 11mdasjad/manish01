@extends('layouts.app')

@section('title', 'Projects & Developments | Mais Agro House')
@section('meta_description', 'Explore flagship completed and ongoing projects: luxury apartments, gated residential plotted enclaves, and organic farmland estates.')

@section('content')
<x-breadcrumb 
  title="Our Projects & Developments" 
  subtitle="Showcasing Landmark Developments in Luxury Residential Apartments, Gated Plotted Communities & Farmland Enclaves"
  :items="['Projects' => route('projects.index')]" 
/>

<section class="hm-section bg-slate-50">
  <div class="container">
    {{-- Sector Filters --}}
    <div class="d-flex flex-wrap gap-2 justify-content-center mb-5">
      <a href="{{ route('projects.index') }}" class="hm-btn {{ !request('sector') ? 'hm-btn-primary' : 'hm-btn-outline' }} hm-btn-sm">
        All Sectors
      </a>
      @foreach($sectors as $sec)
        <a href="{{ route('projects.index', ['sector' => $sec]) }}" class="hm-btn {{ request('sector') == $sec ? 'hm-btn-primary' : 'hm-btn-outline' }} hm-btn-sm">
          {{ $sec }}
        </a>
      @endforeach
    </div>

    {{-- Projects Grid --}}
    <div class="row g-4">
      @foreach($projects as $proj)
        <div class="col-lg-6">
          <div class="hm-card">
            <div class="hm-card-img-wrap" style="aspect-ratio: 16/9;">
              <img src="{{ $proj->image_url }}" alt="{{ $proj->title }}" loading="lazy">
              <span class="hm-card-badge">{{ $proj->sector ?? 'Infrastructure' }}</span>
            </div>
            <div class="hm-card-body">
              <div class="d-flex flex-wrap align-items-center gap-3 text-xs text-muted mb-2">
                <span><i class="bi bi-geo-alt text-warning"></i> {{ $proj->location }}</span>
                <span>•</span>
                <span><i class="bi bi-wallet2 text-warning"></i> {{ $proj->budget }}</span>
                @if($proj->completion_date)
                  <span>•</span>
                  <span><i class="bi bi-calendar-check text-warning"></i> {{ $proj->completion_date->format('M Y') }}</span>
                @endif
              </div>

              <h3 class="hm-card-title h4">
                <a href="{{ route('projects.show', $proj->slug) }}">{{ $proj->title }}</a>
              </h3>

              <p class="hm-card-desc">{{ Str::limit($proj->scope, 130) }}</p>

              @if($proj->results)
                <div class="p-3 bg-light rounded text-xs text-slate-700 mb-3 border-start border-3 border-warning">
                  <strong class="d-block mb-1 text-dark">Impact / Benchmark Outcome:</strong>
                  {{ Str::limit($proj->results, 120) }}
                </div>
              @endif

              <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                <span class="text-xs text-muted">Client: <strong class="text-dark">{{ $proj->client_name }}</strong></span>
                <a href="{{ route('projects.show', $proj->slug) }}" class="btn btn-sm btn-outline-primary">
                  View Case Study <i class="bi bi-arrow-right text-xs"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-5">
      {{ $projects->links('pagination::bootstrap-5') }}
    </div>
  </div>
</section>
@endsection
