@extends('layouts.admin')

@section('title', 'Manage Commercial Enquiries & RFQs')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Commercial RFQs & Enquiries</h2>
    <p class="text-muted text-sm mb-0">Track Requests for Quotation (RFQs) across bulk commodities, industrial EPC, and farmlands.</p>
  </div>
  <div class="d-flex gap-2">
    <a href="{{ route('admin.enquiries.index', ['status' => 'pending']) }}" class="btn btn-sm btn-warning">
      Pending Leads
    </a>
    <a href="{{ route('admin.enquiries.index') }}" class="btn btn-sm btn-outline-secondary">
      All Enquiries
    </a>
  </div>
</div>

{{-- Filters --}}
<div class="card border-0 shadow-sm rounded-3 mb-4 p-3 bg-white">
  <form action="{{ route('admin.enquiries.index') }}" method="GET" class="row g-2 align-items-center">
    <div class="col-md-5">
      <input type="text" name="search" class="form-control form-control-sm" placeholder="Search by client, company, item..." value="{{ request('search') }}">
    </div>
    <div class="col-md-3">
      <select name="status" class="form-select form-select-sm">
        <option value="">All Statuses</option>
        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="in_review" {{ request('status') === 'in_review' ? 'selected' : '' }}>In Review</option>
        <option value="contacted" {{ request('status') === 'contacted' ? 'selected' : '' }}>Contacted</option>
        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
      </select>
    </div>
    <div class="col-md-2">
      <select name="type" class="form-select form-select-sm">
        <option value="">All Types</option>
        <option value="product" {{ request('type') === 'product' ? 'selected' : '' }}>Product</option>
        <option value="service" {{ request('type') === 'service' ? 'selected' : '' }}>Service</option>
        <option value="project" {{ request('type') === 'project' ? 'selected' : '' }}>Project</option>
      </select>
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-sm btn-secondary w-100">Filter</button>
    </div>
  </form>
</div>

{{-- Table --}}
<div class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light text-xs text-uppercase">
        <tr>
          <th>Ref No</th>
          <th>Requested Item / Subject</th>
          <th>Lead / Company</th>
          <th>Volume / Scope</th>
          <th>Status</th>
          <th>Date</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody class="text-sm">
        @forelse($enquiries as $enq)
          <tr>
            <td>
              <code>HM-RFQ-{{ str_pad($enq->id, 5, '0', STR_PAD_LEFT) }}</code>
            </td>
            <td>
              <strong class="d-block text-dark">{{ $enq->item_name ?? 'General Inquiry' }}</strong>
              <span class="badge bg-light text-dark border text-xs text-uppercase">{{ $enq->type }}</span>
            </td>
            <td>
              <span class="d-block fw-semibold text-dark">{{ $enq->name }}</span>
              <span class="text-xs text-muted">{{ $enq->company ?? $enq->email }}</span>
              @if($enq->phone)
                <span class="text-xs text-primary d-block">{{ $enq->phone }}</span>
              @endif
            </td>
            <td>{{ $enq->quantity_requirement ?? '-' }}</td>
            <td>
              @if($enq->status === 'pending')
                <span class="badge bg-warning text-dark">Pending</span>
              @elseif($enq->status === 'in_review')
                <span class="badge bg-info text-white">In Review</span>
              @elseif($enq->status === 'contacted')
                <span class="badge bg-primary">Contacted</span>
              @elseif($enq->status === 'completed')
                <span class="badge bg-success">Closed</span>
              @else
                <span class="badge bg-secondary">{{ $enq->status }}</span>
              @endif
            </td>
            <td class="text-xs text-muted">{{ $enq->created_at->format('M d, Y') }}</td>
            <td class="text-end">
              <a href="{{ route('admin.enquiries.show', $enq->id) }}" class="btn btn-sm btn-primary py-1 px-2" title="Review RFQ">
                <i class="bi bi-file-earmark-check"></i> Review
              </a>
              <button type="button" class="btn btn-sm btn-outline-danger py-1 px-2" onclick="if(confirm('Delete RFQ record?')) { document.getElementById('del-enq-{{ $enq->id }}').submit(); }">
                <i class="bi bi-trash"></i>
              </button>
              <form id="del-enq-{{ $enq->id }}" action="{{ route('admin.enquiries.destroy', $enq->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="text-center py-5 text-muted">No commercial RFQs found matching criteria.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($enquiries->hasPages())
    <div class="card-footer bg-white py-3">
      {{ $enquiries->links('pagination::bootstrap-5') }}
    </div>
  @endif
</div>
@endsection
