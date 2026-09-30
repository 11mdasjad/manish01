<footer class="hm-footer">
  <div class="container">
    <div class="row g-4 g-lg-5">
      {{-- Column 1: Company Profile --}}
      <div class="col-lg-4 col-md-6">
        <div class="mb-4">
          <img src="{{ \App\Support\MediaHelper::resolve(\App\Models\Setting::get('site_logo'), 'images/logo.png') }}" height="76" width="76" alt="{{ \App\Models\Setting::get('site_name', 'Mais Agro House') }} Logo" class="rounded-3 shadow" style="object-fit: cover; border: 1px solid rgba(255,255,255,0.18);">
        </div>
        <p class="text-slate-400 mb-4" style="line-height: 1.7;">
          {{ \App\Models\Setting::get('footer_about', 'MAIS AGRO HOUSE is a trusted real estate and land investment company based in Bhubaneswar, Odisha. We deliver premium luxury apartments, DTCP-approved residential plots, and organic farmlands with 100% legal title clearance.') }}
        </p>
        <div class="d-flex align-items-center gap-2">
          <a href="{{ \App\Models\Setting::get('social_linkedin', 'https://linkedin.com') }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-light rounded-circle" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-linkedin"></i>
          </a>
          <a href="{{ \App\Models\Setting::get('social_twitter', 'https://twitter.com') }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-light rounded-circle" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-twitter-x"></i>
          </a>
          <a href="{{ \App\Models\Setting::get('social_facebook', 'https://facebook.com') }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-light rounded-circle" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-facebook"></i>
          </a>
          <a href="{{ \App\Models\Setting::get('social_youtube', 'https://youtube.com') }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-light rounded-circle" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-youtube"></i>
          </a>
        </div>
      </div>

      {{-- Column 2: Quick Links --}}
      <div class="col-lg-2 col-md-6 col-6">
        <h5>Explore</h5>
        <ul class="hm-footer-links">
          <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right text-xs"></i> Home</a></li>
          <li><a href="{{ route('about') }}"><i class="bi bi-chevron-right text-xs"></i> About Us</a></li>
          <li><a href="{{ route('projects.index') }}"><i class="bi bi-chevron-right text-xs"></i> Project Portfolio</a></li>
          <li><a href="{{ route('products.index') }}"><i class="bi bi-chevron-right text-xs"></i> Properties for Sale</a></li>
          <li><a href="{{ route('services.index') }}"><i class="bi bi-chevron-right text-xs"></i> Our Services</a></li>
          <li><a href="{{ route('gallery.index') }}"><i class="bi bi-chevron-right text-xs"></i> Project Gallery</a></li>
          <li><a href="{{ route('blog.index') }}"><i class="bi bi-chevron-right text-xs"></i> Real Estate Blog</a></li>
          <li><a href="{{ route('contact.index') }}"><i class="bi bi-chevron-right text-xs"></i> Contact Us</a></li>
        </ul>
      </div>

      {{-- Column 3: Properties & Services --}}
      <div class="col-lg-3 col-md-6 col-6">
        <h5>Properties & Advisory</h5>
        <ul class="hm-footer-links">
          <li><a href="{{ route('products.index', ['category' => 'apartments-residential']) }}"><i class="bi bi-chevron-right text-xs"></i> Luxury Apartments</a></li>
          <li><a href="{{ route('products.index', ['category' => 'residential-plots']) }}"><i class="bi bi-chevron-right text-xs"></i> Residential Gated Plots</a></li>
          <li><a href="{{ route('products.index', ['category' => 'farm-land-investment']) }}"><i class="bi bi-chevron-right text-xs"></i> Managed Organic Farmland</a></li>
          <li><a href="{{ route('products.index', ['category' => 'investment-properties']) }}"><i class="bi bi-chevron-right text-xs"></i> Commercial Growth Land</a></li>
          <li><a href="{{ route('services.show', 'legally-verified-property-due-diligence') }}"><i class="bi bi-chevron-right text-xs"></i> 30-Yr Legal Due Diligence</a></li>
          <li><a href="{{ route('services.show', 'guided-site-visits-layout-inspections') }}"><i class="bi bi-chevron-right text-xs"></i> Free Guided Site Visits</a></li>
        </ul>
      </div>

      {{-- Column 4: Contact & Locations --}}
      <div class="col-lg-3 col-md-6">
        <h5>Corporate Office</h5>
        <div class="d-flex flex-column gap-3 text-slate-300">
          <div>
            <span class="text-warning fw-bold text-xs d-block text-uppercase">Bhubaneswar Head Office</span>
            <span class="small">{{ \App\Models\Setting::get('contact_address', 'Patia - Nandankanan Road, Near KIIT Square, Bhubaneswar, Odisha 751024') }}</span>
          </div>
          <div>
            <span class="text-warning fw-bold text-xs d-block text-uppercase">Working Hours</span>
            <span class="small">{{ \App\Models\Setting::get('office_hours', 'Monday - Sunday: 09:00 AM - 07:00 PM (Site visits open all days)') }}</span>
          </div>
          <div class="pt-2 border-top border-secondary">
            <a href="tel:{{ \App\Models\Setting::getDigits('contact_phone', '918008007062') }}" class="text-slate-300 text-decoration-none hover:text-white small d-block mb-1">
              <i class="bi bi-telephone-fill text-warning me-2"></i> {{ \App\Models\Setting::get('contact_phone', '+91 80080 07062') }} (Desk 1)
            </a>
            <a href="tel:{{ \App\Models\Setting::getDigits('contact_phone_alt', '919009008014') }}" class="text-slate-300 text-decoration-none hover:text-white small d-block mb-1">
              <i class="bi bi-phone-fill text-warning me-2"></i> {{ \App\Models\Setting::get('contact_phone_alt', '+91 90090 08014') }} (Desk 2)
            </a>
            <a href="{{ \App\Models\Setting::whatsappUrl('whatsapp_number') }}" target="_blank" rel="noopener" class="text-success text-decoration-none hover:text-white small d-block mb-1 fw-semibold">
              <i class="bi bi-whatsapp me-2"></i> WhatsApp: {{ \App\Models\Setting::get('whatsapp_number', '+91 80080 07062') }}
            </a>
            <a href="mailto:{{ \App\Models\Setting::get('contact_email', 'info@maisagrohouse.com') }}" class="text-slate-300 text-decoration-none hover:text-white small d-block">
              <i class="bi bi-envelope text-warning me-2"></i> {{ \App\Models\Setting::get('contact_email', 'info@maisagrohouse.com') }}
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Bottom Bar --}}
  <div class="hm-footer-bottom">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
      <div>
        &copy; {{ date('Y') }} {{ \App\Models\Setting::get('site_name', 'Mais Agro House') }}. All rights reserved.
      </div>
      <div class="d-flex align-items-center gap-4">
        <a href="{{ route('legal.privacy') }}" class="text-slate-400 hover:text-white">Privacy Policy</a>
        <a href="{{ route('legal.terms') }}" class="text-slate-400 hover:text-white">Terms of Business</a>
        <a href="{{ route('sitemap') }}" class="text-slate-400 hover:text-white">XML Sitemap</a>
        <a href="#main-content" class="text-warning text-decoration-none" title="Back to top">
          <i class="bi bi-arrow-up-circle fs-5"></i>
        </a>
      </div>
    </div>
  </div>
</footer>
