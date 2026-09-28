@extends('layouts.app')

@section('title', 'Privacy Policy & Data Governance | HarshMais Global')
@section('meta_description', 'Corporate privacy policy and data governance practices of HarshMais Global Enterprises.')

@section('content')
<x-breadcrumb 
  title="Privacy Policy & Data Governance" 
  subtitle="Transparency in How We Process Commercial Inquiries, Technical Briefs and Personal Data"
  :items="['Privacy Policy' => route('legal.privacy')]" 
/>

<section class="hm-section bg-slate-50">
  <div class="container">
    <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm border max-w-4xl mx-auto text-slate-700" style="line-height: 1.8;">
      <h3 class="fw-bold text-dark mb-3">1. Executive Overview</h3>
      <p>
        HarshMais Global Enterprises ("HarshMais", "Group", "We", "Us") is committed to protecting the privacy and confidentiality of corporate clients, institutional partners, land investors, and website visitors. This policy governs how we collect, process, store, and protect information submitted through our commercial portals.
      </p>

      <h4 class="fw-bold text-dark mt-4 mb-2">2. Information Collection</h4>
      <p>We collect information you explicitly provide when requesting quotations, submitting trade specifications, downloading technical brochures, or subscribing to market intelligence:</p>
      <ul>
        <li>Contact details: Name, corporate email address, WhatsApp/telephone numbers.</li>
        <li>Commercial details: Company entity, jurisdiction, product requirements, vessel destinations.</li>
        <li>Technical telemetry: IP address, browser type, and interaction cookies to maintain site performance.</li>
      </ul>

      <h4 class="fw-bold text-dark mt-4 mb-2">3. Commercial Purpose of Processing</h4>
      <p>Information collected is strictly utilized for legitimate enterprise operations, including:</p>
      <ul>
        <li>Preparing and issuing Requests for Quotation (RFQs) and proforma invoices.</li>
        <li>Scheduling forensic land title inspections and site visits.</li>
        <li>Ensuring compliance with APEDA, FSSAI, and international anti-money laundering (AML) trade regulations.</li>
      </ul>

      <h4 class="fw-bold text-dark mt-4 mb-2">4. Non-Disclosure & Security</h4>
      <p>
        We do not sell, license, or share proprietary client data with third-party advertisers. Information is only shared with authorized statutory bodies (such as Sub-Registrar offices for property deeds, or port customs authorities for shipping bills) as strictly required to execute agreed contracts.
      </p>

      <h4 class="fw-bold text-dark mt-4 mb-2">5. Inquiries & Data Rights</h4>
      <p class="mb-0">
        To request data modification, verification, or deletion, please contact our Data Governance Officer at <a href="mailto:privacy@harshmais.com" class="text-primary fw-bold">privacy@harshmais.com</a>.
      </p>
    </div>
  </div>
</section>
@endsection
