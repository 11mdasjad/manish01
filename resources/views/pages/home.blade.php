@extends('layouts.app')

@section('title', 'Mais Agro House | Luxury Apartments, Verified Plots & Farmland in Bhubaneswar')
@section('meta_description', 'Explore legally verified residential plots, luxury apartments, and fertile farmland investments in Bhubaneswar by Mais Agro House.')

@section('content')
{{-- MAIS AGRO HOUSE LUXURY VIDEO HERO BANNER --}}
<section class="hm-video-hero position-relative">
  {{-- Cinematic Background Video with Company Property Image Poster Fallback --}}
  <video class="hm-hero-video-bg" autoplay muted loop playsinline poster="{{ asset('images/hero-banner.png') }}" id="heroVideo">
    <source src="{{ asset('videos/hero-video.mp4') }}" type="video/mp4">
    {{-- Fallback for browsers that don't support video --}}
    <img src="{{ asset('images/hero-banner.png') }}" alt="Mais Agro House Commercial Properties Bhubaneswar" class="hm-hero-img-bg">
  </video>
  <div class="hm-hero-video-overlay"></div>
  <div class="container hm-video-hero-content text-center">
    <div class="row justify-content-center">
      <div class="col-xl-9 col-lg-10">
        {{-- Mais Agro House Corporate Brand Logo in Banner --}}
        <div class="hm-hero-logo-box">
          <img src="{{ asset('images/logo.png') }}" alt="Mais Agro House" class="hm-hero-logo">
        </div>
        <div>
          <span class="badge bg-warning text-dark text-uppercase fw-bold px-3 py-2 mb-3 rounded-pill letter-spacing-1">
            <i class="bi bi-geo-alt-fill me-1"></i> {{ \App\Models\Setting::get('hero_badge', "Bhubaneswar's Premier Real Estate") }}
          </span>
        </div>
        <h1 class="hm-video-title">{{ \App\Models\Setting::get('hero_title', 'Building The Homes Of Your Tomorrow.') }}</h1>
        <p class="hm-video-desc">
          {{ \App\Models\Setting::get('hero_subtitle', "MAIS AGRO HOUSE brings you exquisite residential apartments, DTCP-approved gated plotted communities, and fertile organic farmlands across Bhubaneswar's prime growth corridors. 100% clear titles & peace of mind.") }}
        </p>
        <div class="pt-3 d-flex flex-wrap justify-content-center gap-3 hm-hero-btns">
          <a href="#featured-projects" class="hm-btn-learn-more">
            <i class="bi bi-building me-1"></i> EXPLORE PROPERTIES
          </a>
          <button type="button" class="hm-btn hm-btn-gold" data-bs-toggle="modal" data-bs-target="#enquiryModal">
            <i class="bi bi-calendar2-check-fill me-1"></i> SCHEDULE SITE VISIT
          </button>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- KEY REAL ESTATE STATS STRIP --}}
<div class="hm-stats-strip">
  <div class="container">
    <div class="row g-3 g-md-4 justify-content-center">
      <div class="col-6 col-lg-3">
        <div class="hm-stat-box">
          <div class="hm-stat-number hm-counter" data-target="{{ \App\Models\Setting::get('stat_years', '14+') }}">
            {{ \App\Models\Setting::get('stat_years', '14+') }}
          </div>
          <div class="hm-stat-label">Years Real Estate Heritage</div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="hm-stat-box">
          <div class="hm-stat-number hm-counter" data-target="{{ \App\Models\Setting::get('stat_projects', '1.8M+ Sq.Ft') }}">
            {{ \App\Models\Setting::get('stat_projects', '1.8M+ Sq.Ft') }}
          </div>
          <div class="hm-stat-label">Developed & Handed Over</div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="hm-stat-box">
          <div class="hm-stat-number hm-counter" data-target="{{ \App\Models\Setting::get('stat_tonnage', '100%') }}">
            {{ \App\Models\Setting::get('stat_tonnage', '100%') }}
          </div>
          <div class="hm-stat-label">Verified Legal Clear Titles</div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="hm-stat-box">
          <div class="hm-stat-number hm-counter" data-target="{{ \App\Models\Setting::get('stat_clients', '650+') }}">
            {{ \App\Models\Setting::get('stat_clients', '650+') }}
          </div>
          <div class="hm-stat-label">Happy Homeowners & Investors</div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- 4-PILLAR REAL ESTATE METHODOLOGY --}}
<section class="hm-section hm-section-alt">
  <div class="container">
    <div class="text-center mb-5">
      <span class="hm-badge"><i class="bi bi-shield-check"></i> THE MAIS AGRO HOUSE ADVANTAGE</span>
      <h2 class="hm-section-title">Apartments, Residential Plots & Farmland Investments</h2>
      <p class="hm-section-subtitle">
        Delivering enduring property value through rigorous legal title clearance, superior architectural planning, and transparent documentation.
      </p>
    </div>

    <div class="row g-4">
      <div class="col-lg-3 col-md-6">
        <div class="hm-method-card">
          <div class="hm-method-number">01</div>
          <h4 class="fw-bold mb-3">Master Layouts & Demarcation</h4>
          <p class="text-slate-600 text-sm mb-0">
            Engineered layout schemes featuring wide 30ft/40ft black-top roads, dedicated avenue plantation, street lighting, and clear boundary demarcation pillars.
          </p>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="hm-method-card">
          <div class="hm-method-number">02</div>
          <h4 class="fw-bold mb-3">Modern Architectural Integrity</h4>
          <p class="text-slate-600 text-sm mb-0">
            Earthquake-resistant RCC framed structures, contemporary elevations, maximum natural cross-ventilation, and high-standard electrical and sanitary fixtures.
          </p>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="hm-method-card">
          <div class="hm-method-number">03</div>
          <h4 class="fw-bold mb-3">Forensic 30-Yr Legal Due Diligence</h4>
          <p class="text-slate-600 text-sm mb-0">
            Absolute legal safety: 30-year mutation tracing, nil-encumbrance certificates (EC), approved bank financing with leading institutions, and hassle-free registration.
          </p>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="hm-method-card">
          <div class="hm-method-number">04</div>
          <h4 class="fw-bold mb-3">Fertile Farmland & Eco Living</h4>
          <p class="text-slate-600 text-sm mb-0">
            Rich agricultural parcels with deep borewell irrigation, perimeter fencing, fruit plantation setups, and high appreciation in expanding Bhubaneswar suburbs.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ONGOING & COMPLETED PROJECTS SHOWCASE --}}
<section class="hm-section bg-slate-50" id="featured-projects">
  <div class="container">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4">
      <div>
        <span class="hm-badge"><i class="bi bi-buildings"></i> PREMIER REAL ESTATE DEVELOPMENTS</span>
        <h2 class="hm-section-title mb-0">Discover Our Ongoing & Completed Projects</h2>
      </div>
      <div class="mt-3 mt-md-0 d-flex gap-2">
        <button type="button" class="btn btn-sm btn-primary hm-project-filter-btn active" data-filter="all">All Projects</button>
        <button type="button" class="btn btn-sm btn-outline-secondary hm-project-filter-btn" data-filter="completed">Completed</button>
        <button type="button" class="btn btn-sm btn-outline-secondary hm-project-filter-btn" data-filter="ongoing">Under Development</button>
      </div>
    </div>

    <div class="row g-4" id="projectContainer">
      @forelse($featuredProjects as $proj)
        <div class="col-lg-4 col-md-6 hm-project-item" data-category="{{ $proj->status ? 'completed' : 'ongoing' }}" data-status="{{ $proj->status ? 'completed' : 'ongoing' }}">
          <div class="hm-card position-relative">
            <span class="hm-project-badge badge-few-left">{{ $proj->sector ?? 'Verified Property' }}</span>
            <div class="hm-card-img-wrap" style="aspect-ratio: 16/10;">
              <img src="{{ $proj->featured_image_url }}" alt="{{ $proj->title }}" loading="lazy">
            </div>
            <div class="hm-card-body">
              <div class="d-flex align-items-center gap-2 text-xs text-muted mb-2">
                <i class="bi bi-geo-alt-fill text-danger"></i> <span>{{ $proj->location }}</span>
                <span>•</span>
                <span class="text-success fw-bold">Verified Title</span>
              </div>
              <h4 class="fw-bold mb-2">
                <a href="{{ route('projects.show', $proj->slug) }}" class="text-dark text-decoration-none">
                  {{ $proj->title }}
                </a>
              </h4>
              <p class="text-slate-600 text-sm mb-3">
                {{ Str::limit($proj->scope, 130) }}
              </p>
              <div class="p-2 bg-light rounded text-xs text-slate-700 mb-3 border">
                <strong>Project Sector:</strong> {{ $proj->sector ?? 'Residential' }} • Legal Verified
              </div>
              <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                <span class="text-xs text-muted">Status: <strong class="{{ $proj->status ? 'text-success' : 'text-warning' }}">{{ $proj->status ? 'Completed' : 'Under Development' }}</strong></span>
                <a href="{{ route('projects.show', $proj->slug) }}" class="btn btn-sm btn-outline-primary">
                  View Project <i class="bi bi-arrow-right text-xs"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center py-4">
          <p class="text-muted">No projects available at this moment.</p>
        </div>
      @endforelse
    </div>
  </div>
</section>

{{-- ABOUT COMPANY SECTION --}}
<section class="hm-section hm-section-alt">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <div class="position-relative">
          <img src="{{ asset('images/properties/luxury-villa.jpg') }}" alt="Mais Agro House Real Estate Bhubaneswar" class="img-fluid rounded-4 shadow-xl" style="border: 4px solid #ffffff;">
          <div class="position-absolute bottom-0 start-0 translate-middle-y bg-dark text-white p-4 rounded-3 shadow-lg d-none d-md-block" style="max-width: 320px; margin-left: 20px;">
            <div class="d-flex align-items-center gap-3">
              <i class="bi bi-award-fill text-warning fs-1"></i>
              <div>
                <h5 class="fw-bold text-white mb-0">RERA & ISO Certified</h5>
                <p class="text-xs text-slate-400 mb-0">100% Forensic Due Diligence, Clear Titles & RERA Compliance</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <span class="hm-badge"><i class="bi bi-building"></i> ABOUT MAIS AGRO HOUSE</span>
        <h2 class="hm-section-title">The Benchmark of Trust in Bhubaneswar Real Estate</h2>
        <p class="lead text-slate-600 mb-4">
          MAIS AGRO HOUSE is a premier real estate development and investment company based in Bhubaneswar, Odisha. We deliver premium luxury apartments, verified residential plots, and smart organic farmlands backed by complete 30-year forensic legal documentation.
        </p>

        <div class="row g-4 mb-4">
          <div class="col-sm-6">
            <div class="d-flex gap-3">
              <div class="hm-feature-icon"><i class="bi bi-shield-check"></i></div>
              <div>
                <h6 class="fw-bold mb-1">Legally Verified Properties</h6>
                <p class="text-xs text-slate-500 mb-0">Every property undergoes strict title clearance, mutation verification, and transparent paperwork.</p>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="d-flex gap-3">
              <div class="hm-feature-icon"><i class="bi bi-file-earmark-text"></i></div>
              <div>
                <h6 class="fw-bold mb-1">Inquiry to Registration</h6>
                <p class="text-xs text-slate-500 mb-0">Dedicated guidance from free site visits, bank home loan approvals to smooth deed registration.</p>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="d-flex gap-3">
              <div class="hm-feature-icon"><i class="bi bi-houses"></i></div>
              <div>
                <h6 class="fw-bold mb-1">Well-Planned Communities</h6>
                <p class="text-xs text-slate-500 mb-0">Modern apartments & gated layouts equipped with library, miniplex, jogging track, and 24/7 security.</p>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="d-flex gap-3">
              <div class="hm-feature-icon"><i class="bi bi-tree"></i></div>
              <div>
                <h6 class="fw-bold mb-1">Smart Farmland Assets</h6>
                <p class="text-xs text-slate-500 mb-0">Secure organic agricultural parcels yielding capital appreciation and periodic farm revenue.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="d-flex align-items-center gap-3 hm-about-ctas">
          <a href="{{ route('about') }}" class="hm-btn hm-btn-primary">
            Read Corporate Profile <i class="bi bi-arrow-right"></i>
          </a>
          <a href="{{ route('team.index') }}" class="hm-btn hm-btn-outline">
            Meet Leadership Board
          </a>
        </div>
      </div>
    </div>
  </div>
</section>


{{-- SERVICES SECTION --}}
<section class="hm-section hm-section-dark">
  <div class="container">
    <div class="text-center mb-5">
      <span class="hm-badge hm-badge-light"><i class="bi bi-gear-wide-connected"></i> CLIENT-CENTRIC SERVICES</span>
      <h2 class="hm-section-title">Comprehensive Real Estate, Construction & Legal Guidance</h2>
      <p class="hm-section-subtitle">
        Turnkey property solutions engineered to the highest standards across residential layout demarcation, 30-year forensic legal clearance, and architectural construction.
      </p>
    </div>

    <div class="row g-4">
      @foreach($featuredServices as $serv)
        <div class="col-lg-6">
          <div class="hm-service-box text-dark">
            <div class="d-flex align-items-start gap-4">
              <div class="hm-service-icon flex-shrink-0">
                <i class="bi {{ $serv->icon ?? 'bi-gear-fill' }}"></i>
              </div>
              <div class="flex-grow-1">
                <span class="text-xs text-uppercase fw-bold text-warning">{{ $serv->category->name ?? 'Real Estate Service' }}</span>
                <h4 class="fw-bold mt-1 mb-2">
                  <a href="{{ route('services.show', $serv->slug) }}" class="text-dark text-decoration-none hover:text-primary">
                    {{ $serv->title }}
                  </a>
                </h4>
                <p class="text-slate-600 text-sm mb-3">
                  {{ $serv->short_description }}
                </p>

                @if(!empty($serv->features) && is_array($serv->features))
                  <ul class="list-unstyled text-xs text-slate-700 mb-4">
                    @foreach(array_slice($serv->features, 0, 3) as $feat)
                      <li class="mb-1"><i class="bi bi-check-circle-fill text-success me-2"></i> {{ $feat }}</li>
                    @endforeach
                  </ul>
                @endif

                <div class="d-flex align-items-center gap-3">
                  <a href="{{ route('services.show', $serv->slug) }}" class="hm-btn hm-btn-primary hm-btn-sm">
                    Explore Service <i class="bi bi-arrow-right"></i>
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
  </div>
</section>

{{-- WORLD-CLASS COMMUNITY AMENITIES SHOWCASE --}}
<section class="hm-section bg-white">
  <div class="container">
    <div class="text-center mb-5">
      <span class="hm-badge"><i class="bi bi-stars"></i> ELEVATED LIFESTYLE</span>
      <h2 class="hm-section-title">World-Class Masterplanned Amenities</h2>
      <p class="hm-section-subtitle">
        Every Mais Agro House enclave is thoughtfully equipped with modern lifestyle infrastructure designed for health, recreation, and family happiness.
      </p>
    </div>

    <div class="row g-4">
      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 transition-all hover-translate-y">
          <div style="height: 220px; overflow: hidden;">
            <img src="{{ asset('images/amenities/library.jpg') }}" alt="Modern Community Library" class="w-100 h-100 object-fit-cover">
          </div>
          <div class="card-body p-4">
            <div class="d-flex align-items-center gap-2 mb-2 text-warning">
              <i class="bi bi-book-half fs-5"></i>
              <span class="text-xs fw-bold text-uppercase text-slate-600">Education & Focus</span>
            </div>
            <h5 class="fw-bold mb-2">Modern Community Library</h5>
            <p class="text-slate-600 text-sm mb-0">Air-conditioned quiet study pavilion with high-speed Wi-Fi and curated collections for students & professionals.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 transition-all hover-translate-y">
          <div style="height: 220px; overflow: hidden;">
            <img src="{{ asset('images/amenities/cinema.jpg') }}" alt="Private Resident Miniplex" class="w-100 h-100 object-fit-cover">
          </div>
          <div class="card-body p-4">
            <div class="d-flex align-items-center gap-2 mb-2 text-warning">
              <i class="bi bi-film fs-5"></i>
              <span class="text-xs fw-bold text-uppercase text-slate-600">Entertainment</span>
            </div>
            <h5 class="fw-bold mb-2">Resident Miniplex & Amphitheatre</h5>
            <p class="text-slate-600 text-sm mb-0">Private 4K acoustic screening hall for community movie nights, live matches, and private resident functions.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 transition-all hover-translate-y">
          <div style="height: 220px; overflow: hidden;">
            <img src="{{ asset('images/amenities/jogging.jpg') }}" alt="Landscaped Jogging Track" class="w-100 h-100 object-fit-cover">
          </div>
          <div class="card-body p-4">
            <div class="d-flex align-items-center gap-2 mb-2 text-warning">
              <i class="bi bi-activity fs-5"></i>
              <span class="text-xs fw-bold text-uppercase text-slate-600">Health & Wellness</span>
            </div>
            <h5 class="fw-bold mb-2">Jogging & Cycling Tracks</h5>
            <p class="text-slate-600 text-sm mb-0">Shaded perimeter track surrounded by flowering avenue trees, reflexology trails, and outdoor fitness stations.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 transition-all hover-translate-y">
          <div style="height: 220px; overflow: hidden;">
            <img src="{{ asset('images/amenities/medical.jpg') }}" alt="24/7 Medical Care Unit" class="w-100 h-100 object-fit-cover">
          </div>
          <div class="card-body p-4">
            <div class="d-flex align-items-center gap-2 mb-2 text-warning">
              <i class="bi bi-heart-pulse-fill fs-5"></i>
              <span class="text-xs fw-bold text-uppercase text-slate-600">Safety & Care</span>
            </div>
            <h5 class="fw-bold mb-2">24/7 Medical & Emergency Support</h5>
            <p class="text-slate-600 text-sm mb-0">On-site primary medical post, 24/7 ambulance tie-up, and emergency first-responder assistance for families.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 transition-all hover-translate-y">
          <div style="height: 220px; overflow: hidden;">
            <img src="{{ asset('images/amenities/fountain.jpg') }}" alt="Central Illuminated Fountain" class="w-100 h-100 object-fit-cover">
          </div>
          <div class="card-body p-4">
            <div class="d-flex align-items-center gap-2 mb-2 text-warning">
              <i class="bi bi-droplet-fill fs-5"></i>
              <span class="text-xs fw-bold text-uppercase text-slate-600">Landscape & Relaxation</span>
            </div>
            <h5 class="fw-bold mb-2">Central Fountain & Zen Gardens</h5>
            <p class="text-slate-600 text-sm mb-0">Breathtaking water features, ambient evening illumination, and serene seating alcoves for peaceful unwinding.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 transition-all hover-translate-y">
          <div style="height: 220px; overflow: hidden;">
            <img src="{{ asset('images/amenities/commercial.jpg') }}" alt="Integrated Commercial Center" class="w-100 h-100 object-fit-cover">
          </div>
          <div class="card-body p-4">
            <div class="d-flex align-items-center gap-2 mb-2 text-warning">
              <i class="bi bi-shop fs-5"></i>
              <span class="text-xs fw-bold text-uppercase text-slate-600">Convenience</span>
            </div>
            <h5 class="fw-bold mb-2">Commercial Center & Daily Needs</h5>
            <p class="text-slate-600 text-sm mb-0">Integrated retail spaces hosting daily groceries, coffee parlor, and essentials right at your enclave entrance.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- REAL ESTATE HOME LOAN & EMI CALCULATOR --}}
<section class="hm-section hm-section-alt">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <span class="hm-badge"><i class="bi bi-calculator"></i> FINANCIAL PLANNING</span>
        <h2 class="hm-section-title">Home Loan & Property EMI Calculator</h2>
        <p class="text-slate-600 mb-4">
          Calculate your estimated monthly installment and financing structure for luxury apartments, duplex homes, or residential plotted development.
        </p>

        <div class="bg-light p-4 rounded-4 border shadow-sm">
          <div class="mb-3">
            <label class="form-label fw-bold text-dark text-sm">Estimated Property Loan Amount (₹)</label>
            <input type="number" id="emiAmount" class="form-control" value="5000000" step="100000">
            <span class="text-xs text-muted">e.g. ₹ 50,00,000 (50 Lakhs)</span>
          </div>

          <div class="row g-3 mb-3">
            <div class="col-6">
              <label class="form-label fw-bold text-dark text-sm">Interest Rate (%)</label>
              <input type="number" id="emiRate" class="form-control" value="8.5" step="0.1">
            </div>
            <div class="col-6">
              <label class="form-label fw-bold text-dark text-sm">Tenure (Years)</label>
              <input type="number" id="emiTenure" class="form-control" value="15" step="1">
            </div>
          </div>

          <button type="button" id="hmCalculateEmiBtn" class="hm-btn hm-btn-gold w-100">
            <i class="bi bi-calculator-fill"></i> Calculate Monthly Installment
          </button>
        </div>
      </div>

      <div class="col-lg-6">
        <div id="emiResultBox" class="p-4 p-md-5 rounded-4 text-white shadow-xl" style="background: linear-gradient(135deg, var(--hm-primary-950) 0%, var(--hm-primary-850) 100%);">
          <span class="badge bg-warning text-dark text-uppercase fw-bold mb-2">Estimated Breakdown</span>
          <h4 class="text-white fw-bold mb-4">Your Projected Monthly Payment</h4>

          <div class="mb-4">
            <span class="text-white-50 text-xs text-uppercase d-block fw-bold">Monthly EMI</span>
            <div class="display-6 fw-extrabold text-warning" id="emiResultMonthly">₹ 49,237</div>
          </div>

          <div class="row g-3 pt-3 border-top border-white-15">
            <div class="col-6">
              <span class="text-white-50 text-xs text-uppercase d-block">Total Interest Payable</span>
              <span class="fw-bold text-white fs-5" id="emiResultInterest">₹ 38,62,642</span>
            </div>
            <div class="col-6">
              <span class="text-white-50 text-xs text-uppercase d-block">Total Amount Payable</span>
              <span class="fw-bold text-white fs-5" id="emiResultTotal">₹ 88,62,642</span>
            </div>
          </div>

          <div class="mt-4 pt-3 border-top border-white-15 text-xs text-white-50">
            *Indicative estimates subject to banking criteria and official institutional terms.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- TESTIMONIALS SECTION --}}
@if($testimonials->isNotEmpty())
<section class="hm-section bg-slate-50">
  <div class="container">
    <div class="text-center mb-5">
      <span class="hm-badge"><i class="bi bi-chat-quote"></i> CLIENT EXPERIENCES</span>
      <h2 class="hm-section-title">Why Buyers & Investors Trust Us</h2>
      <p class="hm-section-subtitle">
        Real feedback from proud apartment owners, plotted land buyers, and farm estate investors across Bhubaneswar.
      </p>
    </div>

    <div class="row g-4">
      @foreach($testimonials as $test)
        <div class="col-lg-4 col-md-6">
          <div class="hm-testimonial-card">
            <div>
              <div class="hm-stars">
                @for($i = 0; $i < $test->rating; $i++)
                  <i class="bi bi-star-fill"></i>
                @endfor
              </div>
              <p class="hm-testimonial-text">"{{ $test->content }}"</p>
            </div>
            <div class="hm-testimonial-author">
              <img src="{{ $test->avatar_url }}" alt="{{ $test->client_name }}" class="hm-testimonial-avatar">
              <div>
                <h6 class="fw-bold mb-0 text-dark">{{ $test->client_name }}</h6>
                <span class="text-xs text-muted d-block">{{ $test->client_title }}</span>
                <span class="text-xs text-primary fw-semibold">{{ $test->company }}</span>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- CLIENTS / PARTNERS --}}
@if($clients->isNotEmpty())
<section class="hm-section-sm bg-white border-top border-bottom">
  <div class="container">
    <div class="text-center mb-4">
      <span class="text-uppercase fw-bold text-xs text-muted letter-spacing-1">Associated Financial Institutions & Statutory Approvals</span>
    </div>
    <div class="row g-3 justify-content-center align-items-center">
      @foreach($clients as $c)
        <div class="col-6 col-md-3 col-lg-3">
          <div class="hm-client-logo text-center">
            <span class="fw-bold">{{ $c->name }}</span>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- LATEST BLOGS / NEWS --}}
@if($latestBlogs->isNotEmpty())
<section class="hm-section hm-section-alt">
  <div class="container">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5">
      <div>
        <span class="hm-badge"><i class="bi bi-newspaper"></i> REAL ESTATE JOURNAL</span>
        <h2 class="hm-section-title mb-0">Market Trends, Land Law & Investment Insights</h2>
      </div>
      <div class="mt-3 mt-md-0">
        <a href="{{ route('blog.index') }}" class="hm-btn hm-btn-outline">
          View All Insights <i class="bi bi-arrow-right"></i>
        </a>
      </div>
    </div>

    <div class="row g-4">
      @foreach($latestBlogs as $blog)
        <div class="col-lg-4 col-md-6">
          <div class="hm-card">
            <div class="hm-card-img-wrap">
              <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" loading="lazy">
              @if($blog->category)
                <span class="hm-card-badge">{{ $blog->category->name }}</span>
              @endif
            </div>
            <div class="hm-card-body">
              <div class="d-flex align-items-center gap-2 text-xs text-muted mb-2">
                <span><i class="bi bi-calendar3"></i> {{ $blog->published_at ? $blog->published_at->format('M d, Y') : 'Recent' }}</span>
                <span>•</span>
                <span><i class="bi bi-clock"></i> {{ $blog->reading_time }}</span>
              </div>
              <h4 class="hm-card-title">
                <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
              </h4>
              <p class="hm-card-desc">{{ Str::limit($blog->excerpt, 110) }}</p>
              <div class="mt-auto pt-3 border-top">
                <a href="{{ route('blog.show', $blog->slug) }}" class="fw-bold text-primary text-sm text-decoration-none">
                  Read Article <i class="bi bi-arrow-right text-xs"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- STRONG CTA BANNER --}}
<section class="hm-section py-5">
  <div class="container">
    <div class="hm-cta-banner">
      <div class="row align-items-center g-4 position-relative" style="z-index: 2;">
        <div class="col-lg-8">
          <span class="badge bg-warning text-dark text-uppercase fw-bold mb-2">Connect with Mais Agro House</span>
          <h2 class="text-white fw-extrabold display-6 mb-3">Begin Your Property Journey in Bhubaneswar Today</h2>
          <p class="text-slate-300 lead mb-0">
            Speak with our property advisors or book an exclusive guided site tour with pick-and-drop facility across Patia, Raghunathpur, and Nandankanan Road.
          </p>
        </div>
        <div class="col-lg-4 text-lg-end">
          <div class="d-flex flex-column flex-sm-row flex-lg-column gap-3 justify-content-lg-end">
            <button class="hm-btn hm-btn-gold hm-btn-lg" data-bs-toggle="modal" data-bs-target="#enquiryModal">
              <i class="bi bi-calendar2-check-fill"></i> Schedule Guided Site Tour
            </button>
            <a href="{{ route('contact.index') }}" class="hm-btn hm-btn-outline-white hm-btn-lg">
              <i class="bi bi-telephone-fill"></i> Speak With Property Advisor
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
