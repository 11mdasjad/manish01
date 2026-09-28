@extends('layouts.admin')

@section('title', 'Review RFQ: HM-RFQ-' . str_pad($enquiry->id, 5, '0', STR_PAD_LEFT))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Commercial RFQ #HM-RFQ-{{ str_pad($enquiry->id, 5, '0', STR_PAD_LEFT) }}</h2>
    <p class="text-muted text-sm mb-0">Logged on {{ $enquiry->created_at->format('F d, Y \a\t h:i A') }}</p>
  </div>
  <a href="{{ route('admin.enquiries.index') }}" class="btn btn-outline-secondary btn-sm">
    <i class="bi bi-arrow-left me-1"></i> Back to Enquiries
  </a>
</div>

<div class="row g-4">
  {{-- Left: RFQ Details --}}
  <div class="col-lg-7">
    <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
      <div class="d-flex justify-content-between align-items-start border-bottom pb-3 mb-4">
        <div>
          <span class="text-xs text-muted text-uppercase fw-bold">Commercial Offering / Target</span>
          <h4 class="fw-bold mb-0 text-dark">{{ $enquiry->item_name ?? 'General Business Brief' }}</h4>
        </div>
        <span class="badge bg-primary text-uppercase">{{ $enquiry->type }}</span>
      </div>

      @if($enquiry->quantity_requirement)
        <div class="p-3 bg-light rounded-3 mb-4 border d-flex justify-content-between align-items-center">
          <span class="text-xs text-muted text-uppercase fw-bold">Volume / Target Scope:</span>
          <strong class="text-warning fs-5">{{ $enquiry->quantity_requirement }}</strong>
        </div>
      @endif

      <div class="mb-4">
        <label class="text-xs text-muted text-uppercase fw-bold d-block mb-2">Detailed Specifications / Client Requirements</label>
        <div class="p-4 bg-light rounded-3 text-slate-800 border" style="line-height: 1.8; font-size: 1rem; white-space: pre-wrap;">{{ $enquiry->message }}</div>
      </div>

      <div class="d-flex gap-2">
        <a href="mailto:{{ $enquiry->email }}?subject=Quotation: {{ urlencode($enquiry->item_name ?? 'HarshMais Commercial Proposal') }}" class="hm-btn hm-btn-primary hm-btn-sm">
          <i class="bi bi-reply-fill"></i> Reply with Formal Proposal
        </a>
      </div>
    </div>
  </div>

  {{-- Right: Status & Internal Admin Notes --}}
  <div class="col-lg-5">
    {{-- Client Profile Card --}}
    <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
      <h5 class="fw-bold mb-3 border-bottom pb-2">Client / Buyer Profile</h5>
      <ul class="list-unstyled text-sm text-slate-600 mb-0">
        <li class="mb-3">
          <span class="text-xs text-muted text-uppercase d-block fw-bold">Representative</span>
          <strong class="text-dark">{{ $enquiry->name }}</strong>
        </li>
        <li class="mb-3">
          <span class="text-xs text-muted text-uppercase d-block fw-bold">Corporate Email</span>
          <a href="mailto:{{ $enquiry->email }}" class="text-primary">{{ $enquiry->email }}</a>
        </li>
        <li class="mb-3">
          <span class="text-xs text-muted text-uppercase d-block fw-bold">Direct Phone / WhatsApp</span>
          <a href="tel:{{ $enquiry->phone }}" class="text-dark fw-bold">{{ $enquiry->phone }}</a>
        </li>
        <li class="mb-0">
          <span class="text-xs text-muted text-uppercase d-block fw-bold">Organization</span>
          <span>{{ $enquiry->company ?? 'Institutional Lead' }}</span>
        </li>
      </ul>
    </div>

    {{-- Pipeline Status & Internal Notes --}}
    <div class="card border-0 shadow-sm rounded-3 p-4 bg-white">
      <h5 class="fw-bold mb-3 border-bottom pb-2">Pipeline Status & Trade Notes</h5>

      <form action="{{ route('admin.enquiries.update-status', $enquiry->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Lead Pipeline Status</label>
          <select name="status" class="form-select">
            <option value="pending" {{ $enquiry->status === 'pending' ? 'selected' : '' }}>Pending Review</option>
            <option value="in_review" {{ $enquiry->status === 'in_review' ? 'selected' : '' }}>Under Engineering / Pricing Review</option>
            <option value="contacted" {{ $enquiry->status === 'contacted' ? 'selected' : '' }}>Client Contacted / Proposal Sent</option>
            <option value="completed" {{ $enquiry->status === 'completed' ? 'selected' : '' }}>Deal Closed / Contract Executed</option>
            <option value="cancelled" {{ $enquiry->status === 'cancelled' ? 'selected' : '' }}>Cancelled / Non-Viable</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Internal Trade Desk Notes</label>
          <textarea name="admin_notes" rows="4" class="form-control text-xs" placeholder="Log CIF quotes given, ocean freight estimates, or site visit notes...">{{ $enquiry->admin_notes }}</textarea>
        </div>

        <button type="submit" class="hm-btn hm-btn-primary w-100 fw-bold">
          <i class="bi bi-check2-circle"></i> Save Pipeline Status & Notes
        </button>
      </form>
    </div>
  </div>
</div>
@endsection
