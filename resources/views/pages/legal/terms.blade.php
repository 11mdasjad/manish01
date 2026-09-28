@extends('layouts.app')

@section('title', 'Terms & Conditions of Business | HarshMais Global')
@section('meta_description', 'Commercial terms and conditions governing quotations, commodity supply contracts, EPC agreements, and website use.')

@section('content')
<x-breadcrumb 
  title="Terms & Conditions of Business" 
  subtitle="Statutory Guidelines Governing Commercial Quotations, Contracts, and Website Interaction"
  :items="['Terms & Conditions' => route('legal.terms')]" 
/>

<section class="hm-section bg-slate-50">
  <div class="container">
    <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm border max-w-4xl mx-auto text-slate-700" style="line-height: 1.8;">
      <h3 class="fw-bold text-dark mb-3">1. Scope of Agreement</h3>
      <p>
        These Terms and Conditions govern access to the web portal of HarshMais Global Enterprises and set forth the framework under which preliminary trade inquiries, commodity specifications, and infrastructure EPC proposals are issued.
      </p>

      <h4 class="fw-bold text-dark mt-4 mb-2">2. Commercial Quotations & Proformas</h4>
      <p>
        All prices, metrics, and specifications displayed on the website or issued via automated preliminary quotation tools are indicative and subject to written contract confirmation. Official trade agreements are executed under designated Incoterms 2020 (FOB/CIF/CFR) with signed commercial invoices.
      </p>

      <h4 class="fw-bold text-dark mt-4 mb-2">3. Land Transactions & Title Conveyance</h4>
      <p>
        All agricultural parcels and farmland plots offered by Mais Agro House division are sold strictly subject to physical revenue verification, mutation clearance at the competent Tahsil, and biometric registration before the Sub-Registrar. Prospective buyers receive official title search certificates compiled by empanelled legal counsel prior to financial commitment.
      </p>

      <h4 class="fw-bold text-dark mt-4 mb-2">4. Intellectual Property</h4>
      <p>
        All group trademarks, logos, architectural layouts, technical diagrams, and published insights are the exclusive intellectual property of HarshMais Global Enterprises. Unauthorized reproduction or scraping is strictly prohibited.
      </p>

      <h4 class="fw-bold text-dark mt-4 mb-2">5. Governing Law & Jurisdiction</h4>
      <p class="mb-0">
        Commercial disputes arising from digital inquiries or corporate agreements are subject to the exclusive jurisdiction of the competent civil courts at Bhubaneswar, Odisha or Mumbai, Maharashtra, India.
      </p>
    </div>
  </div>
</section>
@endsection
