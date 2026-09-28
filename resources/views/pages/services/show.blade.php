@extends('layouts.app')

@section('title', ($service->meta_title ?? $service->title) . ' | HarshMais Global')
@section('meta_description', $service->meta_description ?? Str::limit(strip_tags($service->short_description), 160))
@section('og_image', $service->image_url)

@section('schema')
<script type="application/ld+json">
{
  "{{ '@context' }}": "https://schema.org/",
  "@type": "Service",
  "name": "{{ $service->title }}",
  "serviceType": "{{ $service->category->name ?? 'Corporate Engineering & Supply Chain' }}",
  "provider": {
    "@type": "Corporation",
    "name": "HarshMais Global Enterprises"
  },
  "areaServed": {
    "@type": "Country",
    "name": "India & Global Export Corridors"
  },
  "description": "{{ $service->meta_description ?? Str::limit(strip_tags($service->short_description), 200) }}"
}
</script>
@endsection

@section('content')
<x-breadcrumb 
  :title="$service->title" 
  :subtitle="$service->tagline"
  :items="[
    'Services' => route('services.index'),
    $service->title => route('services.show', $service->slug)
  ]" 
/>

<section class="hm-section bg-slate-50">
  <div class="container">
    <div class="row g-4 g-lg-5">
      {{-- Main Column --}}
      <div class="col-lg-8">
        {{-- Hero Visual --}}
        <div class="position-relative rounded-4 overflow-hidden shadow-sm border mb-4" style="aspect-ratio: 16/9;">
          <img src="{{ $service->image_url }}" alt="{{ $service->title }}" class="w-100 h-100 object-fit-cover">
          <div class="position-absolute bottom-0 start-0 m-4 p-3 bg-dark text-white rounded-3 shadow d-flex align-items-center gap-3 bg-opacity-90">
            <div class="hm-service-icon bg-warning text-dark mb-0" style="width: 44px; height: 44px; font-size: 1.3rem;">
              <i class="bi {{ $service->icon ?? 'bi-gear-fill' }}"></i>
            </div>
            <div>
              <span class="text-xs text-warning fw-bold text-uppercase d-block">Turnkey Division</span>
              <span class="fw-bold">{{ $service->category->name ?? 'Industrial Infrastructure' }}</span>
            </div>
          </div>
        </div>

        {{-- Service Description --}}
        <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm border mb-5">
          <h3 class="fw-bold mb-3">Service Scope & Engineering Overview</h3>
          <p class="lead text-slate-700 mb-4">{{ $service->short_description }}</p>
          
          <div class="text-slate-600 mb-5" style="line-height: 1.8;">
            {!! nl2br(e($service->description)) !!}
          </div>

          {{-- Features Grid --}}
          @if(!empty($service->features) && is_array($service->features))
            <h4 class="fw-bold mb-3 border-top pt-4">Technical Capabilities & Scope</h4>
            <div class="row g-3 mb-5">
              @foreach($service->features as $feat)
                <div class="col-md-6">
                  <div class="p-3 bg-light rounded d-flex gap-3 border">
                    <i class="bi bi-check-circle-fill text-success fs-5 flex-shrink-0"></i>
                    <span class="text-sm fw-semibold text-slate-800">{{ $feat }}</span>
                  </div>
                </div>
              @endforeach
            </div>
          @endif

          {{-- 5-Step Process Timeline --}}
          @if(!empty($service->process_steps) && is_array($service->process_steps))
            <h4 class="fw-bold mb-3 border-top pt-4">Phased Execution Methodology</h4>
            <p class="text-muted text-sm mb-4">Our audited milestone-driven approach guarantees zero compliance delays.</p>
            
            <div class="d-flex flex-column gap-3 mb-5">
              @foreach($service->process_steps as $step)
                <div class="p-3 bg-light rounded-3 border d-flex gap-3 align-items-start">
                  <span class="badge bg-dark fs-6 px-3 py-2 text-warning fw-bold">{{ $step['step'] ?? '0' . ($loop->iteration) }}</span>
                  <div>
                    <h6 class="fw-bold mb-1">{{ $step['title'] }}</h6>
                    <p class="text-slate-600 text-sm mb-0">{{ $step['desc'] }}</p>
                  </div>
                </div>
              @endforeach
            </div>
          @endif

          {{-- Tangible Benefits --}}
          @if(!empty($service->benefits) && is_array($service->benefits))
            <h4 class="fw-bold mb-3 border-top pt-4">Institutional Client Benefits</h4>
            <ul class="list-group list-group-flush mb-0">
              @foreach($service->benefits as $ben)
                <li class="list-group-item px-0 d-flex align-items-center gap-3">
                  <i class="bi bi-arrow-up-right-circle-fill text-primary fs-5"></i>
                  <span class="fw-semibold text-slate-800">{{ $ben }}</span>
                </li>
              @endforeach
            </ul>
          @endif
        </div>
      </div>

      {{-- Sidebar Column --}}
      <div class="col-lg-4">
        {{-- Dedicated Service Enquiry Card --}}
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4 position-sticky" style="top: 100px;">
          <span class="text-xs text-warning fw-bold text-uppercase">Direct Consultation</span>
          <h4 class="fw-bold mb-3">Initiate Service Proposal</h4>
          <p class="text-xs text-muted mb-4">Discuss project specs, site surveys, or procurement scope with our senior engineering directors.</p>

          <form action="{{ route('enquiry.store') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="service">
            <input type="hidden" name="item_id" value="{{ $service->id }}">
            <input type="hidden" name="item_name" value="{{ $service->title }}">
            <input type="text" name="website_hp" style="display:none !important;" tabindex="-1">

            <div class="mb-2">
              <label class="form-label text-xs fw-bold">Full Name *</label>
              <input type="text" name="name" class="form-control form-control-sm" required>
            </div>

            <div class="mb-2">
              <label class="form-label text-xs fw-bold">Corporate Email *</label>
              <input type="email" name="email" class="form-control form-control-sm" required>
            </div>

            <div class="mb-2">
              <label class="form-label text-xs fw-bold">Phone Number *</label>
              <input type="tel" name="phone" class="form-control form-control-sm" required>
            </div>

            <div class="mb-2">
              <label class="form-label text-xs fw-bold">Company / Organization</label>
              <input type="text" name="company" class="form-control form-control-sm">
            </div>

            <div class="mb-3">
              <label class="form-label text-xs fw-bold">Project Details / Location *</label>
              <textarea name="message" rows="3" class="form-control form-control-sm" placeholder="Approximate square footage, land size, timeline, or required specs..." required></textarea>
            </div>

            <button type="submit" class="hm-btn hm-btn-gold w-100 fw-bold">
              <i class="bi bi-send-fill"></i> Submit Service Brief
            </button>
          </form>

          <div class="mt-4 pt-3 border-top text-center">
            <span class="text-xs text-muted d-block mb-1">Direct Engineering Hotline:</span>
            <a href="tel:{{ \App\Models\Setting::get('contact_phone', '+918008007062') }}" class="fw-bold text-dark text-decoration-none">
              <i class="bi bi-telephone text-warning me-1"></i> {{ \App\Models\Setting::get('contact_phone', '+91 8008007062') }}
            </a>
          </div>
        </div>
      </div>
    </div>

    {{-- Related Services --}}
    @if($relatedServices->isNotEmpty())
      <div class="mt-5 pt-4 border-top">
        <h3 class="fw-bold mb-4">Other Group Capabilities</h3>
        <div class="row g-4">
          @foreach($relatedServices as $rel)
            <div class="col-lg-4 col-md-6">
              <div class="hm-card">
                <div class="hm-card-body">
                  <div class="hm-service-icon mb-3" style="width: 48px; height: 48px; font-size: 1.4rem;">
                    <i class="bi {{ $rel->icon ?? 'bi-gear-fill' }}"></i>
                  </div>
                  <h4 class="hm-card-title h5">
                    <a href="{{ route('services.show', $rel->slug) }}">{{ $rel->title }}</a>
                  </h4>
                  <p class="hm-card-desc">{{ Str::limit($rel->short_description, 90) }}</p>
                  <div class="mt-auto pt-3 border-top">
                    <a href="{{ route('services.show', $rel->slug) }}" class="fw-bold text-primary text-sm text-decoration-none">
                      Explore Service <i class="bi bi-arrow-right text-xs"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @endif
  </div>
</section>
@endsection
