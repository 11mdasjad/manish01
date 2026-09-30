{{-- Main Navbar --}}
<header class="hm-header">
  <nav class="navbar navbar-expand-lg navbar-light py-2">
    <div class="container">
      <a class="navbar-brand hm-navbar-brand d-flex align-items-center" href="{{ route('home') }}" aria-label="Home">
        <img src="{{ \App\Support\MediaHelper::resolve(\App\Models\Setting::get('site_logo'), 'images/logo.png') }}" alt="{{ \App\Models\Setting::get('site_name', 'Mais Agro House') }} Logo" class="hm-brand-logo" height="52" style="max-height: 52px; width: auto; max-width: 240px; object-fit: contain;">
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
              @php $navServices = \App\Models\Service::active()->orderBy('order')->take(6)->get(); @endphp
              @forelse($navServices as $ns)
                <li><a class="dropdown-item" href="{{ route('services.show', $ns->slug) }}">{{ $ns->title }}</a></li>
              @empty
                <li><a class="dropdown-item text-muted" href="{{ route('services.index') }}">Explore Services</a></li>
              @endforelse
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
              @php $navPropertyCats = \App\Models\Category::where('type', 'product')->where('is_active', true)->orderBy('order')->get(); @endphp
              @forelse($navPropertyCats as $npc)
                <li><a class="dropdown-item" href="{{ route('products.index', ['category' => $npc->slug]) }}">{{ $npc->name }}</a></li>
              @empty
                <li><a class="dropdown-item" href="{{ route('products.index') }}">All Listings</a></li>
              @endforelse
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
          <a href="{{ \App\Models\Setting::whatsappUrl('whatsapp_number') }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-success fw-bold d-none d-xl-flex align-items-center gap-1 rounded-pill px-3 py-1 text-xs" title="Chat on WhatsApp">
            <i class="bi bi-whatsapp"></i> {{ \App\Models\Setting::get('whatsapp_number', '+91 80080 07062') }}
          </a>
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
      <img src="{{ \App\Support\MediaHelper::resolve(\App\Models\Setting::get('site_logo'), 'images/logo.png') }}" height="48" alt="{{ \App\Models\Setting::get('site_name', 'Mais Agro House') }} Logo" class="rounded-2 shadow-sm" style="max-height: 48px; width: auto; object-fit: contain;">
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
        <i class="bi bi-file-earmark-text"></i> Book Guided Site Tour
      </button>
      <a href="tel:{{ \App\Models\Setting::getDigits('contact_phone', '918008007062') }}" class="hm-btn hm-btn-primary w-100">
        <i class="bi bi-telephone-fill"></i> Call Desk 1: {{ \App\Models\Setting::get('contact_phone', '+91 80080 07062') }}
      </a>
      <a href="tel:{{ \App\Models\Setting::getDigits('contact_phone_alt', '919009008014') }}" class="hm-btn hm-btn-outline-dark w-100">
        <i class="bi bi-phone-fill"></i> Call Desk 2: {{ \App\Models\Setting::get('contact_phone_alt', '+91 90090 08014') }}
      </a>
      <a href="{{ \App\Models\Setting::whatsappUrl('whatsapp_number') }}" target="_blank" rel="noopener" class="btn btn-success w-100 fw-bold py-2">
        <i class="bi bi-whatsapp me-1"></i> WhatsApp: {{ \App\Models\Setting::get('whatsapp_number', '+91 80080 07062') }}
      </a>
    </div>

    <div class="mt-4 pt-3 border-top text-xs text-muted">
      <p class="mb-1"><i class="bi bi-geo-alt"></i> {{ \App\Models\Setting::get('contact_address') }}</p>
      <p class="mb-0"><i class="bi bi-envelope"></i> {{ \App\Models\Setting::get('contact_email') }}</p>
    </div>
  </div>
</div>
