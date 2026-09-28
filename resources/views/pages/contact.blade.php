@extends('layouts.app')

@section('title', 'Contact Us & Office Location | Mais Agro House')
@section('meta_description', 'Connect with Mais Agro House in Bhubaneswar. Patia, Raghunathpur, Nandankanan Road office, site visit booking and property enquiry.')

@section('content')
<x-breadcrumb 
  title="Contact Mais Agro House" 
  subtitle="Connect with Our Real Estate Experts & Schedule a Guided Site Visit"
  :items="['Contact Us' => route('contact.index')]" 
/>

<section class="hm-section bg-slate-50">
  <div class="container">
    {{-- Location Cards --}}
    <div class="row g-4 mb-5">
      {{-- Head Office --}}
      <div class="col-lg-6">
        <div class="p-4 p-md-5 bg-white rounded-4 shadow-sm border h-100">
          <div class="d-flex align-items-center gap-3 mb-3">
            <div class="hm-service-icon bg-warning text-dark mb-0" style="width: 50px; height: 50px; font-size: 1.5rem;">
              <i class="bi bi-geo-alt-fill"></i>
            </div>
            <div>
              <span class="text-xs text-warning fw-bold text-uppercase d-block">Head Office</span>
              <h4 class="fw-bold mb-0">Bhubaneswar Office</h4>
            </div>
          </div>
          <p class="text-slate-600 mb-4">{{ \App\Models\Setting::get('contact_address', 'Bhubaneswar patia raghunathpur nanadankanan road 751024 odisha Landmark Punjab National Bank') }}</p>
          
          <ul class="list-unstyled text-sm text-slate-600 mb-0">
            <li class="mb-2"><i class="bi bi-telephone-fill text-warning me-2"></i> {{ \App\Models\Setting::get('contact_phone', '+91 8008007062') }}</li>
            <li class="mb-2"><i class="bi bi-phone-fill text-warning me-2"></i> {{ \App\Models\Setting::get('contact_phone_alt', '+91 9009008014') }}</li>
            <li class="mb-0"><i class="bi bi-envelope-fill text-warning me-2"></i> {{ \App\Models\Setting::get('contact_email', 'info@maisagrohouse.com') }}</li>
          </ul>
        </div>
      </div>

      {{-- Site Visit & Customer Desk --}}
      <div class="col-lg-6">
        <div class="p-4 p-md-5 bg-white rounded-4 shadow-sm border h-100">
          <div class="d-flex align-items-center gap-3 mb-3">
            <div class="hm-service-icon bg-warning text-dark mb-0" style="width: 50px; height: 50px; font-size: 1.5rem;">
              <i class="bi bi-houses"></i>
            </div>
            <div>
              <span class="text-xs text-warning fw-bold text-uppercase d-block">Site Visits & Consultation</span>
              <h4 class="fw-bold mb-0">Patia - Raghunathpur Desk</h4>
            </div>
          </div>
          <p class="text-slate-600 mb-4">Nandankanan Road, Patia, Bhubaneswar, Odisha 751024 (Landmark: Near Punjab National Bank)</p>
          
          <ul class="list-unstyled text-sm text-slate-600 mb-0">
            <li class="mb-2"><i class="bi bi-telephone-fill text-warning me-2"></i> {{ \App\Models\Setting::get('contact_phone', '+91 8008007062') }}</li>
            <li class="mb-2"><i class="bi bi-clock-fill text-warning me-2"></i> {{ \App\Models\Setting::get('office_hours', 'Mon - Sun: 09:00 AM - 07:00 PM') }}</li>
            <li class="mb-0"><i class="bi bi-envelope-fill text-warning me-2"></i> {{ \App\Models\Setting::get('contact_email', 'info@maisagrohouse.com') }}</li>
          </ul>
        </div>
      </div>
    </div>

    {{-- Contact Form & Interactive Map --}}
    <div class="row g-4 g-lg-5">
      {{-- Interactive Form Column --}}
      <div class="col-lg-7">
        <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm border">
          <span class="hm-badge"><i class="bi bi-send"></i> DISPATCH INQUIRY</span>
          <h3 class="fw-bold mb-3">Send Official Message</h3>
          <p class="text-slate-600 text-sm mb-4">Complete the form below to connect directly with our corporate relations department.</p>

          <div id="contactFormAlert"></div>

          <form id="corporateContactForm" action="{{ route('contact.store') }}" method="POST">
            @csrf
            {{-- Honeypot Spam Filter --}}
            <input type="text" name="website_hp" style="display:none !important;" tabindex="-1" autocomplete="off">

            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label text-xs fw-bold text-dark">Your Name / Representative <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" placeholder="e.g. Ramesh Chandra" required>
              </div>

              <div class="col-md-6">
                <label class="form-label text-xs fw-bold text-dark">Corporate Email <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control" placeholder="e.g. ramesh@company.com" required>
              </div>

              <div class="col-md-6">
                <label class="form-label text-xs fw-bold text-dark">Phone / WhatsApp Number</label>
                <input type="tel" name="phone" class="form-control" placeholder="+91 80000 00000">
              </div>

              <div class="col-md-6">
                <label class="form-label text-xs fw-bold text-dark">Company / Organization</label>
                <input type="text" name="company" class="form-control" placeholder="Company Name Ltd">
              </div>

              <div class="col-12">
                <label class="form-label text-xs fw-bold text-dark">Subject / Nature of Inquiry</label>
                <input type="text" name="subject" class="form-control" placeholder="e.g. Grain Export Contract / Farmland Site Visit">
              </div>

              <div class="col-12">
                <label class="form-label text-xs fw-bold text-dark">Detailed Inquiry Brief <span class="text-danger">*</span></label>
                <textarea name="message" rows="5" class="form-control" placeholder="Describe your specifications, target timelines, cargo volumes, or questions..." required></textarea>
              </div>

              <div class="col-12 pt-2">
                <button type="submit" class="hm-btn hm-btn-primary hm-btn-lg w-100">
                  <i class="bi bi-send-fill"></i> Dispatch Corporate Inquiry
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

      {{-- Map & Quick FAQ Column --}}
      <div class="col-lg-5">
        {{-- Map Card --}}
        <div class="bg-white p-3 rounded-4 shadow-sm border mb-4 overflow-hidden">
          <div class="ratio ratio-16x9 rounded-3 overflow-hidden">
            <iframe 
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d119743.53328227656!2d85.75704988775618!3d20.301019629168925!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a1909db54817a5b%3A0x9d4b68c2ee066f0!2sBhubaneswar%2C%20Odisha!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin" 
              style="border:0;" 
              allowfullscreen="" 
              loading="lazy" 
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
          <div class="p-2 pt-3 text-center">
            <span class="text-xs text-muted"><i class="bi bi-pin-map-fill text-danger me-1"></i> Landmark: Nandankanan Road Corridor, Bhubaneswar</span>
          </div>
        </div>

        {{-- FAQ Accordion --}}
        <div class="bg-white p-4 rounded-4 shadow-sm border">
          <h5 class="fw-bold mb-3 border-bottom pb-2">Frequently Asked Inquiries</h5>
          
          <div class="accordion accordion-flush" id="contactFaq">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-bold text-sm" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                  How does legal due diligence work for farmland?
                </button>
              </h2>
              <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#contactFaq">
                <div class="accordion-body text-xs text-slate-600">
                  Every parcel undergoes a 30-year forensic genealogical title search, certified non-encumbrance check, and physical DGPS boundary pegging prior to buyer registration.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-bold text-sm" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                  What port facilities do you utilize for grain exports?
                </button>
              </h2>
              <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#contactFaq">
                <div class="accordion-body text-xs text-slate-600">
                  We operate port-side holding silos and automated rail tippler systems connecting directly to deep-water berths at Paradeep, Dhamra, and Visakhapatnam ports.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-bold text-sm" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                  What is the minimum turnkey PEB project scope?
                </button>
              </h2>
              <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#contactFaq">
                <div class="accordion-body text-xs text-slate-600">
                  Our EPC division specializes in industrial structures starting from 25,000 sq.ft up to multi-acre mega logistics parks and automated processing plants.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
