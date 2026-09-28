<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
  {{-- Dynamic SEO Tags --}}
  <title>@yield('title', \App\Models\Setting::get('default_meta_title', 'HarshMais Global Enterprises | Infrastructure, Agro-Commodities & Logistics'))</title>
  <meta name="description" content="@yield('meta_description', \App\Models\Setting::get('default_meta_description', 'Premier multi-disciplinary corporate group leading in agro-commodities export, smart industrial warehousing, commercial real estate, and sustainable farmland investments.'))">
  <meta name="keywords" content="@yield('meta_keywords', 'agro commodities, industrial warehousing EPC, farmland plots, non-basmati rice export, yellow maize, real estate mumbai bhubaneswar, harsh group, mais agro')">
  <link rel="canonical" href="@yield('canonical', url()->current())">

  {{-- Open Graph / Facebook --}}
  <meta property="og:type" content="@yield('og_type', 'website')">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:title" content="@yield('og_title', \App\Models\Setting::get('site_name', 'HarshMais Global Enterprises'))">
  <meta property="og:description" content="@yield('og_description', \App\Models\Setting::get('default_meta_description', 'Pioneering Sustainable Infrastructure, Agro-Commodities & Enterprise Logistics'))">
  <meta property="og:image" content="@yield('og_image', asset('images/logo.png'))">

  {{-- Twitter Meta --}}
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="@yield('og_title', \App\Models\Setting::get('site_name', 'HarshMais Global Enterprises'))">
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
  <link rel="stylesheet" href="{{ asset('css/corporate-theme.css') }}?v=1.0.0">

  {{-- Schema.org Organization Structured Data --}}
  <script type="application/ld+json">
  {
    "{{ '@context' }}": "https://schema.org",
    "@type": "Corporation",
    "name": "{{ \App\Models\Setting::get('site_name', 'HarshMais Global Enterprises') }}",
    "alternateName": "Harsh & Mais Group",
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
    "contactPoint": {
      "@type": "ContactPoint",
      "telephone": "{{ \App\Models\Setting::get('contact_phone') }}",
      "contactType": "Customer Service",
      "areaServed": "Global",
      "availableLanguage": ["English", "Hindi"]
    },
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

  {{-- Harsh Group Style Floating WhatsApp Button (Bottom-Left Circular) --}}
  <a href="https://wa.me/918008007062?text={{ urlencode('Hello HarshMais Global Team, I would like to inquire regarding infrastructure / commodities / land projects.') }}" target="_blank" rel="noopener" class="hm-float-whatsapp" title="Chat on WhatsApp">
    <i class="bi bi-whatsapp"></i>
    <span class="hm-float-whatsapp-pulse"></span>
  </a>

  {{-- Footer Component --}}
  @include('components.footer')

  {{-- Bootstrap 5.3 JS Bundle --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  {{-- Corporate Core JS --}}
  <script src="{{ asset('js/corporate-app.js') }}?v=1.0.0"></script>

  @stack('scripts')
</body>
</html>
