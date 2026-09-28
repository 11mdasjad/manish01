{{-- Main Navbar --}}
<header class="hm-header">
  <nav class="navbar navbar-expand-lg navbar-light py-2">
    <div class="container">
      <a class="navbar-brand hm-navbar-brand d-flex align-items-center" href="{{ route('home') }}" aria-label="Home">
        <img src="{{ asset('images/logo.png') }}" alt="Mais Agro House Logo" class="hm-brand-logo" height="52" style="max-height: 52px; width: auto; max-width: 240px; object-fit: contain;">
      </a>

      {{-- Mobile Toggle Button --}}
      <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#hmMobileMenu" aria-controls="hmMobileMenu" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      {{-- Desktop Navigation --}}
      <div class="collapse navbar-collapse d-none d-lg-flex" id="navbarNav">
        <ul class="navbar-nav mx-auto align-items-center">
          <li class="nav-item">
            <a class="nav-link hm-nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">HOME</a>
          </li>
          <li class="nav-item">
            <a class="nav-link hm-nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">ABOUT US</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link hm-nav-link dropdown-toggle {{ request()->routeIs('services.*') ? 'active' : '' }}" href="{{ route('services.index') }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              OUR SERVICES
            </a>
            <ul class="dropdown-menu border-0 shadow-lg py-2">
              <li><a class="dropdown-item fw-semibold" href="{{ route('services.index') }}">All Real Estate Services</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="{{ route('services.show', 'legally-verified-property-due-diligence') }}">Legally Verified Due Diligence</a></li>
              <li><a class="dropdown-item" href="{{ route('services.show', 'support-from-inquiry-to-registration') }}">Inquiry to Registration Support</a></li>
              <li><a class="dropdown-item" href="{{ route('services.show', 'guided-site-visits-layout-inspections') }}">Guided Site Visits & Tours</a></li>
              <li><a class="dropdown-item" href="{{ route('services.show', 'farmland-investment-strategic-land-advisory') }}">Farmland & Land Banking Advisory</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link hm-nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}" href="{{ route('projects.index') }}">OUR PROJECTS</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link hm-nav-link dropdown-toggle {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              PROPERTIES
            </a>
            <ul class="dropdown-menu border-0 shadow-lg py-2">
              <li><a class="dropdown-item fw-semibold" href="{{ route('products.index') }}">All Properties & Land</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="{{ route('products.index', ['category' => 'apartments-residential']) }}">Apartments & Residential</a></li>
              <li><a class="dropdown-item" href="{{ route('products.index', ['category' => 'residential-plots']) }}">Residential Plots</a></li>
              <li><a class="dropdown-item" href="{{ route('products.index', ['category' => 'farm-land-investment']) }}">Farm Land Investment</a></li>
              <li><a class="dropdown-item" href="{{ route('products.index', ['category' => 'investment-properties']) }}">Commercial & Investment Land</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link hm-nav-link" href="{{ route('home') }}#testimonials">CLIENT TESTIMONIALS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link hm-nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}" href="{{ route('blog.index') }}">BLOG</a>
          </li>
          <li class="nav-item">
            <a class="nav-link hm-nav-link" href="{{ route('home') }}#calculator">EMI CALCULATOR</a>
          </li>
        </ul>

        <div class="d-flex align-items-center gap-2">
          <a href="{{ route('contact.index') }}" class="hm-btn-red">
            CONTACT US
          </a>
        </div>
      </div>
    </div>
  </nav>
</header>

{{-- Mobile Offcanvas Drawer --}}
<div class="offcanvas offcanvas-start" tabindex="-1" id="hmMobileMenu" aria-labelledby="hmMobileMenuLabel">
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title" id="hmMobileMenuLabel">
      <img src="{{ asset('images/logo.png') }}" height="48" alt="Logo" class="rounded-2 shadow-sm">
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body p-4">
    <ul class="nav flex-column gap-2 mb-4">
      <li class="nav-item"><a class="nav-link text-dark fw-bold" href="{{ route('home') }}"><i class="bi bi-house-door me-2 text-warning"></i> Home</a></li>
      <li class="nav-item"><a class="nav-link text-dark fw-bold" href="{{ route('about') }}"><i class="bi bi-info-circle me-2 text-warning"></i> About Us</a></li>
      <li class="nav-item"><a class="nav-link text-dark fw-bold" href="{{ route('products.index') }}"><i class="bi bi-houses me-2 text-warning"></i> Properties & Plots</a></li>
      <li class="nav-item"><a class="nav-link text-dark fw-bold" href="{{ route('services.index') }}"><i class="bi bi-shield-check me-2 text-warning"></i> Real Estate Services</a></li>
      <li class="nav-item"><a class="nav-link text-dark fw-bold" href="{{ route('projects.index') }}"><i class="bi bi-buildings me-2 text-warning"></i> Projects & Layouts</a></li>
      <li class="nav-item"><a class="nav-link text-dark fw-bold" href="{{ route('team.index') }}"><i class="bi bi-people me-2 text-warning"></i> Leadership Team</a></li>
      <li class="nav-item"><a class="nav-link text-dark fw-bold" href="{{ route('gallery.index') }}"><i class="bi bi-images me-2 text-warning"></i> Photo Gallery</a></li>
      <li class="nav-item"><a class="nav-link text-dark fw-bold" href="{{ route('blog.index') }}"><i class="bi bi-newspaper me-2 text-warning"></i> Real Estate Blog</a></li>
      <li class="nav-item"><a class="nav-link text-dark fw-bold" href="{{ route('contact.index') }}"><i class="bi bi-envelope me-2 text-warning"></i> Contact Us</a></li>
    </ul>

    <div class="d-grid gap-2">
      <button class="hm-btn hm-btn-gold w-100" data-bs-toggle="modal" data-bs-target="#enquiryModal">
        <i class="bi bi-file-earmark-text"></i> Submit Commercial RFQ
      </button>
      <a href="tel:{{ \App\Models\Setting::get('contact_phone', '+918008007062') }}" class="hm-btn hm-btn-primary w-100">
        <i class="bi bi-telephone-fill"></i> Call Trade Desk
      </a>
    </div>

    <div class="mt-4 pt-3 border-top text-xs text-muted">
      <p class="mb-1"><i class="bi bi-geo-alt"></i> {{ \App\Models\Setting::get('contact_address') }}</p>
      <p class="mb-0"><i class="bi bi-envelope"></i> {{ \App\Models\Setting::get('contact_email') }}</p>
    </div>
  </div>
</div>
