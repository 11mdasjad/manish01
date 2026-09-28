@extends('layouts.app')

@section('title', $project->title . ' | HarshMais Project Case Study')
@section('meta_description', Str::limit(strip_tags($project->scope), 160))
@section('og_image', $project->image_url)

@section('content')
<x-breadcrumb 
  :title="$project->title" 
  :subtitle="$project->sector . ' • ' . $project->location"
  :items="[
    'Portfolio' => route('projects.index'),
    $project->title => route('projects.show', $project->slug)
  ]" 
/>

<section class="hm-section bg-slate-50">
  <div class="container">
    <div class="row g-4 g-lg-5">
      {{-- Main Case Study Content --}}
      <div class="col-lg-8">
        {{-- Hero Project Visual --}}
        <div class="rounded-4 overflow-hidden shadow-sm border mb-4" style="aspect-ratio: 16/9;">
          <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-100 h-100 object-fit-cover">
        </div>

        @if(!empty($project->gallery) && is_array($project->gallery))
          <div class="row g-2 mb-4">
            @foreach($project->gallery as $gImg)
              <div class="col-6 col-md-4">
                <a href="{{ $gImg }}" class="hm-lightbox-trigger d-block rounded overflow-hidden border" style="height: 120px;">
                  <img src="{{ $gImg }}" alt="Gallery Image" class="w-100 h-100 object-fit-cover">
                </a>
              </div>
            @endforeach
          </div>
        @endif

        {{-- Case Study Narrative --}}
        <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm border mb-5">
          <h3 class="fw-bold mb-3">Project Scope & Charter</h3>
          <p class="lead text-slate-700 mb-4">{{ $project->scope }}</p>

          {{-- Challenge --}}
          @if($project->challenge)
            <div class="mb-4">
              <h4 class="fw-bold text-dark d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-octagon-fill text-danger fs-5"></i>
                The Engineering & Site Challenge
              </h4>
              <p class="text-slate-600 ps-4 border-start border-3 border-danger py-1" style="line-height: 1.8;">
                {{ $project->challenge }}
              </p>
            </div>
          @endif

          {{-- Solution --}}
          @if($project->solution)
            <div class="mb-4">
              <h4 class="fw-bold text-dark d-flex align-items-center gap-2">
                <i class="bi bi-lightbulb-fill text-warning fs-5"></i>
                Our Technical & Strategic Solution
              </h4>
              <p class="text-slate-600 ps-4 border-start border-3 border-warning py-1" style="line-height: 1.8;">
                {{ $project->solution }}
              </p>
            </div>
          @endif

          {{-- Results --}}
          @if($project->results)
            <div class="mb-0">
              <h4 class="fw-bold text-dark d-flex align-items-center gap-2">
                <i class="bi bi-trophy-fill text-success fs-5"></i>
                Measured Outcomes & Value Delivered
              </h4>
              <div class="p-3 bg-success-subtle text-dark rounded-3 border border-success-subtle" style="line-height: 1.8;">
                {{ $project->results }}
              </div>
            </div>
          @endif
        </div>
      </div>

      {{-- Sidebar Facts --}}
      <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
          <h5 class="fw-bold mb-3 border-bottom pb-2">Project Factsheet</h5>
          <ul class="list-unstyled text-sm text-slate-600 mb-4">
            <li class="mb-3">
              <span class="text-xs text-muted text-uppercase d-block fw-bold">Client / Entity</span>
              <strong class="text-dark">{{ $project->client_name }}</strong>
            </li>
            <li class="mb-3">
              <span class="text-xs text-muted text-uppercase d-block fw-bold">Geographic Location</span>
              <strong class="text-dark">{{ $project->location }}</strong>
            </li>
            <li class="mb-3">
              <span class="text-xs text-muted text-uppercase d-block fw-bold">Industry Sector</span>
              <span class="badge bg-primary text-uppercase">{{ $project->sector }}</span>
            </li>
            @if($project->budget)
              <li class="mb-3">
                <span class="text-xs text-muted text-uppercase d-block fw-bold">Investment Outlay / Budget</span>
                <strong class="text-warning fs-5">{{ $project->budget }}</strong>
              </li>
            @endif
            @if($project->completion_date)
              <li class="mb-0">
                <span class="text-xs text-muted text-uppercase d-block fw-bold">Date of Handover</span>
                <strong class="text-dark">{{ $project->completion_date->format('F d, Y') }}</strong>
              </li>
            @endif
          </ul>

          <button class="hm-btn hm-btn-gold w-100" onclick="openEnquiryModal('project', '{{ $project->id }}', '{{ addslashes($project->title) }}')">
            <i class="bi bi-chat-left-dots-fill"></i> Inquire Similar Project
          </button>
        </div>

        {{-- Direct Contact Box --}}
        <div class="p-4 bg-dark text-white rounded-4 shadow-sm text-center">
          <i class="bi bi-headset fs-1 text-warning d-block mb-2"></i>
          <h5 class="fw-bold text-white mb-1">Corporate Infrastructure Desk</h5>
          <p class="text-xs text-slate-300 mb-3">Speak directly with our senior project directors regarding joint ventures or EPC tenders.</p>
          <a href="tel:{{ \App\Models\Setting::get('contact_phone', '+918008007062') }}" class="hm-btn hm-btn-outline-white w-100 hm-btn-sm">
            {{ \App\Models\Setting::get('contact_phone', '+91 8008007062') }}
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
