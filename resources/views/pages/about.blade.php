@extends('layouts.app')

@section('title', 'About Us | Mais Agro House')
@section('meta_description', 'Discover the history, leadership, and mission of Mais Agro House, trusted real estate company in Bhubaneswar.')

@section('content')
<x-breadcrumb 
  title="About Mais Agro House" 
  subtitle="Trusted Real Estate Solutions in Bhubaneswar • Apartments, Residential Plots & Farmland Investments"
  :items="['About Us' => route('about')]" 
/>

{{-- SECTION 1: CORPORATE OVERVIEW --}}
<section class="hm-section hm-section-alt">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <span class="hm-badge"><i class="bi bi-clock-history"></i> OUR STORY & VALUES</span>
        <h2 class="hm-section-title">Built on Legal Transparency, Clear Titles & Trust</h2>
        <p class="lead text-slate-700 mb-4">
          MAIS AGRO HOUSE is a trusted real estate company based in Bhubaneswar, Odisha, providing apartments, residential plots, and investment properties with complete legal transparency.
        </p>
        <p class="text-slate-600 mb-4">
          Our mission is to help individuals and investors find secure and valuable land opportunities for residential development, farming, and long-term investment. Every property we offer is legally verified, ensuring safe and smooth transactions while giving our customers confidence in every investment decision.
        </p>
        
        <div class="row g-3 pt-2">
          <div class="col-sm-6">
            <div class="p-3 bg-light rounded-3 border-start border-4 border-warning">
              <h6 class="fw-bold mb-1">Head Office</h6>
              <p class="text-xs text-muted mb-0">Patia, Raghunathpur, Nandankanan Road, Bhubaneswar 751024.</p>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="p-3 bg-light rounded-3 border-start border-4 border-primary">
              <h6 class="fw-bold mb-1">Key Landmark</h6>
              <p class="text-xs text-muted mb-0">Near Punjab National Bank, Raghunathpur, Nandankanan Road.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="position-relative">
          <img src="{{ asset('images/maisagro/about-us.webp') }}" alt="Mais Agro House Real Estate Bhubaneswar" class="img-fluid rounded-4 shadow-xl">
          <div class="position-absolute bottom-0 end-0 bg-white p-4 rounded-3 shadow-lg m-4 border d-none d-md-block" style="max-width: 240px;">
            <div class="d-flex align-items-center gap-3">
              <div class="hm-stat-number text-warning mb-0">14+</div>
              <div>
                <span class="fw-bold d-block text-dark">Years of</span>
                <span class="text-xs text-muted">Real Estate Trust</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- SECTION 2: MISSION, VISION & VALUES --}}
<section class="hm-section bg-slate-50">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-4">
        <div class="hm-card p-4">
          <div class="hm-service-icon bg-warning-subtle text-warning mb-3">
            <i class="bi bi-compass-fill"></i>
          </div>
          <h3 class="fw-bold h4 mb-3">Our Mission</h3>
          <p class="text-slate-600 mb-0">
            To simplify property ownership in Bhubaneswar by providing legally verified residential plots, elegant modern apartments, and managed farmlands with absolute title clarity and honest guidance from inquiry to registration.
          </p>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="hm-card p-4">
          <div class="hm-service-icon bg-warning-subtle text-warning mb-3">
            <i class="bi bi-eye-fill"></i>
          </div>
          <h3 class="fw-bold h4 mb-3">Our Vision</h3>
          <p class="text-slate-600 mb-0">
            To be Bhubaneswar's most trusted real estate brand, synonymous with zero-dispute land assets, masterplanned gated living, and long-term capital appreciation for families and discerning investors.
          </p>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="hm-card p-4">
          <div class="hm-service-icon bg-success-subtle text-success mb-3">
            <i class="bi bi-shield-shaded"></i>
          </div>
          <h3 class="fw-bold h4 mb-3">Core Values</h3>
          <ul class="list-unstyled text-slate-600 text-sm mb-0">
            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> <strong>Radical Integrity:</strong> 30-year forensic mutation checks and clear titles.</li>
            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> <strong>Customer Trust:</strong> Transparent pricing with zero hidden charges.</li>
            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> <strong>Masterplanned Living:</strong> Wide paved roads, drainage & lifestyle amenities.</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- SECTION 3: CORPORATE TIMELINE / MILESTONES --}}
<section class="hm-section hm-section-alt">
  <div class="container">
    <div class="text-center mb-5">
      <span class="hm-badge"><i class="bi bi-graph-up-arrow"></i> OUR JOURNEY</span>
      <h2 class="hm-section-title">A Legacy of Reliable Real Estate Growth</h2>
      <p class="hm-section-subtitle">Key milestones in our mission to transform property buying in Bhubaneswar.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-3 col-6">
        <div class="p-4 border rounded-3 bg-white h-100 shadow-sm border-top border-4 border-warning">
          <span class="h2 fw-extrabold text-warning d-block mb-2">2010</span>
          <h5 class="fw-bold mb-2">Founding in Bhubaneswar</h5>
          <p class="text-xs text-slate-500 mb-0">Inception of Mais Agro House to provide legally transparent land advisory and gated residential plots.</p>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="p-4 border rounded-3 bg-white h-100 shadow-sm border-top border-4 border-warning">
          <span class="h2 fw-extrabold text-warning d-block mb-2">2015</span>
          <h5 class="fw-bold mb-2">Gated Enclaves Handover</h5>
          <p class="text-xs text-slate-500 mb-0">Successful delivery of our first multi-acre gated plotted development in Patia corridor with 100% legal registry.</p>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="p-4 border rounded-3 bg-white h-100 shadow-sm border-top border-4 border-success">
          <span class="h2 fw-extrabold text-success d-block mb-2">2020</span>
          <h5 class="fw-bold mb-2">Apartment Developments</h5>
          <p class="text-xs text-slate-500 mb-0">Expansion into premium residential apartments and duplex projects with modern lifestyle amenities.</p>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="p-4 border rounded-3 bg-white h-100 shadow-sm border-top border-4 border-dark">
          <span class="h2 fw-extrabold text-dark d-block mb-2">2026</span>
          <h5 class="fw-bold mb-2">Eco-Farmlands & Townships</h5>
          <p class="text-xs text-slate-500 mb-0">Pioneering fertile organic farmland investments and integrated masterplanned communities across Odisha.</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- SECTION 4: LEADERSHIP BOARD --}}
<section class="hm-section bg-slate-50">
  <div class="container">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5">
      <div>
        <span class="hm-badge"><i class="bi bi-people"></i> CORPORATE GOVERNANCE</span>
        <h2 class="hm-section-title mb-0">Executive Board & Leadership</h2>
      </div>
      <div class="mt-3 mt-md-0">
        <a href="{{ route('team.index') }}" class="hm-btn hm-btn-outline">
          View Complete Team <i class="bi bi-arrow-right"></i>
        </a>
      </div>
    </div>

    <div class="row g-4">
      @foreach($leadership as $member)
        <div class="col-lg-4 col-md-6">
          <div class="hm-card">
            <div class="hm-card-img-wrap" style="aspect-ratio: 1/1;">
              <img src="{{ $member->image_url }}" alt="{{ $member->name }}" loading="lazy">
              <span class="hm-card-badge">{{ $member->department }}</span>
            </div>
            <div class="hm-card-body">
              <h4 class="fw-bold mb-1">{{ $member->name }}</h4>
              <span class="text-xs text-warning fw-bold text-uppercase d-block mb-3">{{ $member->designation }}</span>
              <p class="text-slate-600 text-sm mb-3">{{ Str::limit($member->bio, 120) }}</p>
              
              <div class="mt-auto pt-3 border-top d-flex align-items-center gap-3">
                @if($member->linkedin_url)
                  <a href="{{ $member->linkedin_url }}" target="_blank" class="text-warning fs-5"><i class="bi bi-linkedin"></i></a>
                @endif
                @if($member->email)
                  <a href="mailto:{{ $member->email }}" class="text-muted text-xs text-decoration-none">
                    <i class="bi bi-envelope me-1"></i> {{ $member->email }}
                  </a>
                @endif
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- SECTION 5: CERTIFICATIONS & ACCREDITATIONS --}}
<section class="hm-section hm-section-dark">
  <div class="container text-center">
    <span class="hm-badge hm-badge-light mb-3"><i class="bi bi-patch-check"></i> STATUTORY ASSURANCE</span>
    <h2 class="hm-section-title mb-4">Complete Legal Verification & Regulatory Approvals</h2>
    <div class="row g-4 justify-content-center pt-3">
      <div class="col-md-3 col-6">
        <div class="p-3 bg-white-10 rounded border border-white-15">
          <i class="bi bi-shield-check text-warning fs-1 d-block mb-2"></i>
          <h6 class="text-white fw-bold mb-0">RERA Compliant</h6>
          <span class="text-xs text-white-50">Odisha Real Estate Authority</span>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="p-3 bg-white-10 rounded border border-white-15">
          <i class="bi bi-file-earmark-ruled text-warning fs-1 d-block mb-2"></i>
          <h6 class="text-white fw-bold mb-0">DTCP Approved</h6>
          <span class="text-xs text-white-50">Master Layout Sanctions</span>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="p-3 bg-white-10 rounded border border-white-15">
          <i class="bi bi-patch-check-fill text-warning fs-1 d-block mb-2"></i>
          <h6 class="text-white fw-bold mb-0">30-Yr Clear Title</h6>
          <span class="text-xs text-white-50">Forensic Legal Verification</span>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="p-3 bg-white-10 rounded border border-white-15">
          <i class="bi bi-bank text-warning fs-1 d-block mb-2"></i>
          <h6 class="text-white fw-bold mb-0">Bank Approved</h6>
          <span class="text-xs text-white-50">Pre-Approved Home Loans</span>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
