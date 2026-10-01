<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  
  {{-- Dynamic SEO Tags --}}
  <title>@yield('title', \App\Models\Setting::get('default_meta_title', 'Mais Agro House | Luxury Apartments, Plots & Farmland in Bhubaneswar'))</title>
  <meta name="description" content="@yield('meta_description', \App\Models\Setting::get('default_meta_description', 'Explore legally verified residential plots, luxury apartments, and fertile farmland investments in Bhubaneswar by Mais Agro House.'))">
  <meta name="keywords" content="@yield('meta_keywords', 'residential plots bhubaneswar, luxury apartments patia, farmland investments, mais agro house, dtcp approved plots, raghunathpur real estate, nandankanan road')">
  <link rel="canonical" href="@yield('canonical', url()->current())">

  {{-- Open Graph / Facebook --}}
  <meta property="og:type" content="@yield('og_type', 'website')">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:title" content="@yield('og_title', \App\Models\Setting::get('site_name', 'Mais Agro House'))">
  <meta property="og:description" content="@yield('og_description', \App\Models\Setting::get('default_meta_description', 'Delivering premier apartments, DTCP-approved plotted developments and organic farmland in Bhubaneswar.'))">
  <meta property="og:image" content="@yield('og_image', asset('images/logo.png'))">

  {{-- Twitter Meta --}}
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="@yield('og_title', \App\Models\Setting::get('site_name', 'Mais Agro House'))">
  <meta name="twitter:description" content="@yield('og_description', \App\Models\Setting::get('default_meta_description'))">
  <meta name="twitter:image" content="@yield('og_image', asset('images/logo.png'))">

  <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

  {{-- Typography: Plus Jakarta Sans & Outfit --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  {{-- Bootstrap 5.3 & Bootstrap Icons --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  {{-- Corporate Theme CSS --}}
  <link rel="stylesheet" href="{{ asset('css/corporate-theme.css') }}?v=1.0.1">

  {{-- Schema.org Organization Structured Data --}}
  <script type="application/ld+json">
  {
    "{{ '@context' }}": "https://schema.org",
    "@type": "Corporation",
    "name": "{{ \App\Models\Setting::get('site_name', 'Mais Agro House') }}",
    "alternateName": "Mais Agro House Real Estate",
    "url": "{{ url('/') }}",
    "logo": "{{ asset('images/logo.png') }}",
    "description": "{{ \App\Models\Setting::get('default_meta_description') }}",
    "foundingDate": "{{ \App\Models\Setting::get('site_established', '2001') }}",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "{{ \App\Models\Setting::get('contact_address') }}",
      "addressLocality": "Bhubaneswar",
      "addressRegion": "Odisha",
      "postalCode": "751024",
      "addressCountry": "IN"
    },
    "contactPoint": [
      {
        "@type": "ContactPoint",
        "telephone": "+91 80080 07062",
        "contactType": "Sales & Site Visits",
        "areaServed": "IN",
        "availableLanguage": ["English", "Hindi", "Odia"]
      },
      {
        "@type": "ContactPoint",
        "telephone": "+91 90090 08014",
        "contactType": "Customer Support",
        "areaServed": "IN",
        "availableLanguage": ["English", "Hindi", "Odia"]
      }
    ],
    "sameAs": [
      "{{ \App\Models\Setting::get('social_linkedin', 'https://linkedin.com') }}",
      "{{ \App\Models\Setting::get('social_twitter', 'https://twitter.com') }}",
      "{{ \App\Models\Setting::get('social_facebook', 'https://facebook.com') }}"
    ]
  }
  </script>

  @stack('styles')
  @yield('schema')
</head>
<body>

  {{-- Navbar Component --}}
  @include('components.navbar')

  {{-- Main Content --}}
  <main id="main-content">
    @include('components.alert')
    @yield('content')
  </main>

  {{-- Enquiry / RFQ Global Modal --}}
  @include('components.enquiry-modal')

  {{-- Global Lightbox Viewer --}}
  <div id="hmLightbox" class="hm-lightbox-modal">
    <span id="hmLightboxClose" class="hm-lightbox-close">&times;</span>
    <img id="hmLightboxImg" class="hm-lightbox-content" src="" alt="Corporate Showcase">
  </div>

  {{-- Harsh Group Style Sticky ENQUIRE NOW Vertical Tab (Right Edge) --}}
  <a href="javascript:void(0)" onclick="openEnquiryModal('general', null, 'General Project Inquiry')" class="hm-sticky-enquire-tab" title="Submit Quick Project Inquiry">
    ENQUIRE NOW
  </a>

  {{-- Floating WhatsApp Widget (Bottom-Left Circular on Desktop) with Dual Number Support --}}
  <div class="hm-float-whatsapp-wrap">
    <div class="hm-whatsapp-popup shadow-lg rounded-4 p-3 border" id="hmWhatsappPopup">
      <div class="d-flex align-items-center justify-content-between mb-2 pb-2 border-bottom">
        <div class="d-flex align-items-center gap-2">
          <i class="bi bi-whatsapp text-success fs-5"></i>
          <div>
            <span class="fw-bold d-block text-xs text-dark">Mais Agro House</span>
            <span class="text-xs text-success d-flex align-items-center gap-1"><span class="badge bg-success rounded-circle p-1"></span> Online Now</span>
          </div>
        </div>
      </div>
      <p class="text-xs text-muted mb-2">Connect instantly on official WhatsApp:</p>
      <div class="d-grid gap-2">
        <a href="{{ \App\Models\Setting::whatsappUrl('whatsapp_number') }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-success d-flex align-items-center justify-content-between text-decoration-none py-2 px-3 rounded-3">
          <span class="d-flex align-items-center gap-2"><i class="bi bi-whatsapp"></i> <span>Desk 1 (Sales)</span></span>
          <span class="fw-bold text-xs">+91 80080 07062</span>
        </a>
        <a href="{{ \App\Models\Setting::whatsappUrl('whatsapp_number_alt') }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-success d-flex align-items-center justify-content-between text-decoration-none py-2 px-3 rounded-3">
          <span class="d-flex align-items-center gap-2"><i class="bi bi-whatsapp"></i> <span>Desk 2 (Advisory)</span></span>
          <span class="fw-bold text-xs">+91 90090 08014</span>
        </a>
      </div>
    </div>
    <a href="{{ \App\Models\Setting::whatsappUrl('whatsapp_number') }}" target="_blank" rel="noopener" class="hm-float-whatsapp" title="Chat on WhatsApp" id="hmFloatWhatsappBtn">
      <i class="bi bi-whatsapp"></i>
      <span class="hm-float-whatsapp-pulse"></span>
    </a>
  </div>

  {{-- Mobile Sticky Bottom Quick Action Bar (Call / WhatsApp / Enquire) --}}
  <div class="hm-mobile-action-bar d-md-none" id="hmMobileActionBar">
    <a href="#hmPhoneModal" data-bs-toggle="modal" data-bs-target="#hmPhoneModal" class="hm-bar-btn hm-bar-btn-call" title="Call Mais Agro House">
      <i class="bi bi-telephone-fill"></i>
      <span>Call Desk</span>
    </a>
    <a href="{{ \App\Models\Setting::whatsappUrl('whatsapp_number') }}" target="_blank" rel="noopener" class="hm-bar-btn hm-bar-btn-wa" title="WhatsApp Chat">
      <i class="bi bi-whatsapp"></i>
      <span>WhatsApp</span>
    </a>
    <a href="javascript:void(0)" onclick="openEnquiryModal('general', null, 'General Project Inquiry')" class="hm-bar-btn hm-bar-btn-enquire" title="Quick Inquiry">
      <i class="bi bi-calendar2-check-fill"></i>
      <span>Site Visit</span>
    </a>
  </div>

  {{-- Quick Contact & Call Chooser Modal for Mobile --}}
  <div class="modal fade" id="hmPhoneModal" tabindex="-1" aria-labelledby="hmPhoneModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content rounded-4 border-0 shadow">
        <div class="modal-header border-bottom py-2">
          <h6 class="modal-title fw-bold" id="hmPhoneModalLabel"><i class="bi bi-headset text-warning me-2"></i> Contact Mais Agro House</h6>
          <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-3">
          <div class="mb-3 p-3 bg-light rounded-3 border">
            <span class="text-xs text-muted d-block text-uppercase fw-bold mb-1">Desk 1 &bull; Sales & Site Visits</span>
            <div class="d-flex align-items-center justify-content-between">
              <span class="fw-bold text-dark">+91 80080 07062</span>
              <div class="d-flex gap-2">
                <a href="tel:+918008007062" class="btn btn-sm btn-primary py-1 px-2" title="Call"><i class="bi bi-telephone-fill"></i></a>
                <a href="{{ \App\Models\Setting::whatsappUrl('whatsapp_number') }}" target="_blank" rel="noopener" class="btn btn-sm btn-success py-1 px-2" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
              </div>
            </div>
          </div>

          <div class="p-3 bg-light rounded-3 border">
            <span class="text-xs text-muted d-block text-uppercase fw-bold mb-1">Desk 2 &bull; Advisory & Support</span>
            <div class="d-flex align-items-center justify-content-between">
              <span class="fw-bold text-dark">+91 90090 08014</span>
              <div class="d-flex gap-2">
                <a href="tel:+919009008014" class="btn btn-sm btn-primary py-1 px-2" title="Call"><i class="bi bi-telephone-fill"></i></a>
                <a href="{{ \App\Models\Setting::whatsappUrl('whatsapp_number_alt') }}" target="_blank" rel="noopener" class="btn btn-sm btn-success py-1 px-2" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Footer Component --}}
  @include('components.footer')

  {{-- Bootstrap 5.3 JS Bundle --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  {{-- Corporate Core JS --}}
  <script src="{{ asset('js/corporate-app.js') }}?v=1.0.1"></script>

  @stack('scripts')
</body>
</html>
