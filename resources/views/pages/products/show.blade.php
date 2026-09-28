@extends('layouts.app')

@section('title', ($product->meta_title ?? $product->name) . ' | HarshMais Global')
@section('meta_description', $product->meta_description ?? Str::limit(strip_tags($product->short_description), 160))
@section('meta_keywords', $product->meta_keywords ?? 'agro commodities, bulk export, ' . $product->name)
@section('og_image', $product->image_url)

@section('schema')
<script type="application/ld+json">
{
  "{{ '@context' }}": "https://schema.org/",
  "@type": "Product",
  "name": "{{ $product->name }}",
  "image": "{{ $product->image_url }}",
  "description": "{{ $product->meta_description ?? Str::limit(strip_tags($product->short_description), 200) }}",
  "sku": "{{ $product->sku ?? 'HM-' . $product->id }}",
  "brand": {
    "@type": "Brand",
    "name": "HarshMais Global Enterprises"
  },
  "offers": {
    "@type": "Offer",
    "url": "{{ url()->current() }}",
    "priceCurrency": "USD",
    "price": "Contact for Quotation",
    "availability": "https://schema.org/InStock"
  }
}
</script>

<script type="application/ld+json">
{
  "{{ '@context' }}": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Home",
      "item": "{{ route('home') }}"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Products",
      "item": "{{ route('products.index') }}"
    },
    {
      "@type": "ListItem",
      "position": 3,
      "name": "{{ $product->name }}",
      "item": "{{ url()->current() }}"
    }
  ]
}
</script>
@endsection

@section('content')
<x-breadcrumb 
  :title="$product->name" 
  :subtitle="$product->tagline"
  :items="[
    'Products' => route('products.index'),
    $product->name => route('products.show', $product->slug)
  ]" 
/>

<section class="hm-section bg-slate-50">
  <div class="container">
    <div class="row g-4 g-lg-5">
      {{-- Left Column: Product Showcase & Details --}}
      <div class="col-lg-8">
        {{-- Main Showcase Image & Gallery --}}
        <div class="bg-white p-3 rounded-4 shadow-sm border mb-4">
          <div class="position-relative overflow-hidden rounded-3 mb-3" style="aspect-ratio: 16/10;">
            <img src="{{ $product->image_url }}" id="mainProductImage" alt="{{ $product->name }}" class="w-100 h-100 object-fit-cover">
            @if($product->category)
              <span class="position-absolute top-0 start-0 m-3 badge bg-dark text-white px-3 py-2">
                {{ $product->category->name }}
              </span>
            @endif
          </div>

          @if(!empty($product->gallery) && is_array($product->gallery))
            <div class="d-flex gap-2 overflow-x-auto pb-2">
              <img src="{{ $product->image_url }}" alt="Thumbnail Main" class="rounded border p-1" style="width: 75px; height: 75px; object-fit: cover; cursor: pointer;" onclick="document.getElementById('mainProductImage').src = this.src;">
              @foreach($product->gallery as $gImg)
                <img src="{{ $gImg }}" alt="Thumbnail Gallery" class="rounded border p-1" style="width: 75px; height: 75px; object-fit: cover; cursor: pointer;" onclick="document.getElementById('mainProductImage').src = this.src;">
              @endforeach
            </div>
          @endif
        </div>

        {{-- Product Information Tabs --}}
        <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm border mb-5">
          <ul class="nav nav-tabs border-bottom mb-4" id="productTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active fw-bold" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab">Detailed Overview</button>
            </li>
            @if(!empty($product->specifications))
              <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button" role="tab">Specifications</button>
              </li>
            @endif
            @if(!empty($product->features))
              <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold" id="features-tab" data-bs-toggle="tab" data-bs-target="#features" type="button" role="tab">Key Features</button>
              </li>
            @endif
            @if(!empty($product->applications))
              <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold" id="apps-tab" data-bs-toggle="tab" data-bs-target="#apps" type="button" role="tab">Commercial Applications</button>
              </li>
            @endif
          </ul>

          <div class="tab-content" id="productTabsContent">
            {{-- Tab 1: Overview --}}
            <div class="tab-pane fade show active" id="overview" role="tabpanel">
              <h4 class="fw-bold mb-3">Commodity & Offering Overview</h4>
              <p class="lead text-slate-700 mb-4">{{ $product->short_description }}</p>
              <div class="text-slate-600" style="line-height: 1.8;">
                {!! nl2br(e($product->description)) !!}
              </div>
            </div>

            {{-- Tab 2: Specifications --}}
            @if(!empty($product->specifications))
              <div class="tab-pane fade" id="specs" role="tabpanel">
                <h4 class="fw-bold mb-3">Technical Specifications Table</h4>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                      <tr>
                        <th style="width: 40%;">Parameter / Criteria</th>
                        <th style="width: 60%;">Guaranteed Standard Specification</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($product->specifications as $key => $val)
                        <tr>
                          <td class="fw-bold text-dark">{{ $key }}</td>
                          <td class="text-slate-700">{{ $val }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            @endif

            {{-- Tab 3: Features --}}
            @if(!empty($product->features))
              <div class="tab-pane fade" id="features" role="tabpanel">
                <h4 class="fw-bold mb-3">Core Quality Advantages</h4>
                <div class="row g-3">
                  @foreach($product->features as $feature)
                    <div class="col-md-6">
                      <div class="p-3 bg-light rounded d-flex align-items-center gap-3 border">
                        <i class="bi bi-patch-check-fill text-success fs-4"></i>
                        <span class="text-sm fw-semibold text-slate-800">{{ $feature }}</span>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            @endif

            {{-- Tab 4: Applications --}}
            @if(!empty($product->applications))
              <div class="tab-pane fade" id="apps" role="tabpanel">
                <h4 class="fw-bold mb-3">Target Uses & Industry Sectors</h4>
                <ul class="list-group list-group-flush">
                  @foreach($product->applications as $app)
                    <li class="list-group-item px-0 d-flex align-items-center gap-2">
                      <i class="bi bi-arrow-right-circle text-primary"></i>
                      <span>{{ $app }}</span>
                    </li>
                  @endforeach
                </ul>
              </div>
            @endif
          </div>
        </div>
      </div>

      {{-- Right Column: Commercial RFQ Desk & Fast Facts --}}
      <div class="col-lg-4">
        {{-- Fast Facts Card --}}
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
          <span class="text-xs text-muted text-uppercase fw-bold">Commercial Terms</span>
          <h3 class="fw-bold text-warning mb-3">{{ $product->price_range ?? 'Commercial RFQ' }}</h3>
          
          <ul class="list-unstyled text-sm text-slate-600 mb-4">
            <li class="mb-2 d-flex justify-content-between">
              <span class="fw-semibold">SKU Code:</span>
              <span>{{ $product->sku ?? 'HM-' . $product->id }}</span>
            </li>
            <li class="mb-2 d-flex justify-content-between">
              <span class="fw-semibold">Origin:</span>
              <span>Eastern & Central India</span>
            </li>
            <li class="mb-2 d-flex justify-content-between">
              <span class="fw-semibold">Inspection:</span>
              <span>SGS / Bureau Veritas Ready</span>
            </li>
            <li class="mb-2 d-flex justify-content-between">
              <span class="fw-semibold">Incoterms:</span>
              <span>FOB, CIF, CFR, Ex-Works</span>
            </li>
          </ul>

          <button class="hm-btn hm-btn-gold w-100 mb-2" onclick="openEnquiryModal('product', '{{ $product->id }}', '{{ addslashes($product->name) }}')">
            <i class="bi bi-file-earmark-text"></i> Quick RFQ Modal
          </button>
        </div>

        {{-- Direct Enquiry Form --}}
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
          <div class="d-flex align-items-center gap-2 mb-3">
            <i class="bi bi-envelope-paper-fill text-warning fs-4"></i>
            <h5 class="fw-bold mb-0">Direct Quotation Request</h5>
          </div>
          <p class="text-xs text-muted mb-3">Submit your specifications directly to our commercial trading desk.</p>

          <form action="{{ route('enquiry.store') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="product">
            <input type="hidden" name="item_id" value="{{ $product->id }}">
            <input type="hidden" name="item_name" value="{{ $product->name }}">
            <input type="text" name="website_hp" style="display:none !important;" tabindex="-1">

            <div class="mb-2">
              <label class="form-label text-xs fw-bold">Full Name *</label>
              <input type="text" name="name" class="form-control form-control-sm" required>
            </div>

            <div class="mb-2">
              <label class="form-label text-xs fw-bold">Corporate Email *</label>
              <input type="email" name="email" class="form-control form-control-sm" required>
            </div>

            <div class="mb-2">
              <label class="form-label text-xs fw-bold">Phone / WhatsApp *</label>
              <input type="tel" name="phone" class="form-control form-control-sm" required>
            </div>

            <div class="mb-2">
              <label class="form-label text-xs fw-bold">Company / Organization</label>
              <input type="text" name="company" class="form-control form-control-sm">
            </div>

            <div class="mb-2">
              <label class="form-label text-xs fw-bold">Estimated Quantity / Volume</label>
              <input type="text" name="quantity_requirement" class="form-control form-control-sm" placeholder="e.g. 5,000 MT / 2 Containers">
            </div>

            <div class="mb-3">
              <label class="form-label text-xs fw-bold">Specification Inquiries *</label>
              <textarea name="message" rows="3" class="form-control form-control-sm" placeholder="Port of delivery, packaging requirements..." required></textarea>
            </div>

            <button type="submit" class="hm-btn hm-btn-primary w-100 hm-btn-sm">
              <i class="bi bi-send-fill"></i> Dispatch RFQ
            </button>
          </form>
        </div>
      </div>
    </div>

    {{-- Related Products --}}
    @if($relatedProducts->isNotEmpty())
      <div class="mt-5 pt-4 border-top">
        <h3 class="fw-bold mb-4">Related Commodities & Offerings</h3>
        <div class="row g-4">
          @foreach($relatedProducts as $rel)
            <div class="col-lg-4 col-md-6">
              <div class="hm-card">
                <div class="hm-card-img-wrap">
                  <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}" loading="lazy">
                  <span class="hm-card-badge">{{ $rel->category->name ?? 'Agro' }}</span>
                </div>
                <div class="hm-card-body">
                  <h4 class="hm-card-title h5">
                    <a href="{{ route('products.show', $rel->slug) }}">{{ $rel->name }}</a>
                  </h4>
                  <p class="hm-card-desc">{{ Str::limit($rel->short_description, 90) }}</p>
                  <div class="hm-card-footer">
                    <span class="text-xs fw-bold text-warning">{{ $rel->price_range ?? 'RFQ' }}</span>
                    <a href="{{ route('products.show', $rel->slug) }}" class="btn btn-sm btn-outline-primary">
                      View Details
                    </a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @endif
  </div>
</section>
@endsection
