@extends('layouts.admin')

@section('title', 'Executive Management Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Executive Dashboard</h2>
    <p class="text-muted text-sm mb-0">Overview of commercial activity, inquiries, catalog items, and portfolio metrics.</p>
  </div>
  <div class="d-flex gap-2">
    <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">
      <i class="bi bi-plus-lg me-1"></i> New Product
    </a>
    <a href="{{ route('admin.services.create') }}" class="btn btn-sm btn-outline-primary">
      <i class="bi bi-plus-lg me-1"></i> New Service
    </a>
  </div>
</div>

{{-- KPI Stat Cards Grid --}}
<div class="row g-3 mb-4">
  {{-- Products --}}
  <div class="col-md-4 col-xl-2 col-6">
    <div class="hm-admin-kpi border-start border-4 border-primary">
      <div>
        <span class="text-xs text-muted text-uppercase fw-bold d-block">Products</span>
        <h3 class="fw-bold mb-0 text-dark">{{ $stats['total_products'] }}</h3>
      </div>
      <div class="hm-admin-kpi-icon bg-primary-subtle text-primary">
        <i class="bi bi-box-seam"></i>
      </div>
    </div>
  </div>

  {{-- Services --}}
  <div class="col-md-4 col-xl-2 col-6">
    <div class="hm-admin-kpi border-start border-4 border-info">
      <div>
        <span class="text-xs text-muted text-uppercase fw-bold d-block">Services</span>
        <h3 class="fw-bold mb-0 text-dark">{{ $stats['total_services'] }}</h3>
      </div>
      <div class="hm-admin-kpi-icon bg-info-subtle text-info">
        <i class="bi bi-gear-wide-connected"></i>
      </div>
    </div>
  </div>

  {{-- Projects --}}
  <div class="col-md-4 col-xl-2 col-6">
    <div class="hm-admin-kpi border-start border-4 border-success">
      <div>
        <span class="text-xs text-muted text-uppercase fw-bold d-block">Projects</span>
        <h3 class="fw-bold mb-0 text-dark">{{ $stats['total_projects'] }}</h3>
      </div>
      <div class="hm-admin-kpi-icon bg-success-subtle text-success">
        <i class="bi bi-buildings"></i>
      </div>
    </div>
  </div>

  {{-- Enquiries --}}
  <div class="col-md-4 col-xl-2 col-6">
    <div class="hm-admin-kpi border-start border-4 border-warning">
      <div>
        <span class="text-xs text-muted text-uppercase fw-bold d-block">Enquiries</span>
        <h3 class="fw-bold mb-0 text-warning">{{ $stats['total_enquiries'] }}</h3>
        <span class="text-xs text-muted">{{ $stats['pending_enquiries'] }} pending</span>
      </div>
      <div class="hm-admin-kpi-icon bg-warning-subtle text-warning">
        <i class="bi bi-file-earmark-text"></i>
      </div>
    </div>
  </div>

  {{-- Contact Messages --}}
  <div class="col-md-4 col-xl-2 col-6">
    <div class="hm-admin-kpi border-start border-4 border-danger">
      <div>
        <span class="text-xs text-muted text-uppercase fw-bold d-block">Messages</span>
        <h3 class="fw-bold mb-0 text-dark">{{ $stats['total_messages'] }}</h3>
        <span class="text-xs text-danger">{{ $stats['unread_messages'] }} unread</span>
      </div>
      <div class="hm-admin-kpi-icon bg-danger-subtle text-danger">
        <i class="bi bi-envelope"></i>
      </div>
    </div>
  </div>

  {{-- Blogs --}}
  <div class="col-md-4 col-xl-2 col-6">
    <div class="hm-admin-kpi border-start border-4 border-secondary">
      <div>
        <span class="text-xs text-muted text-uppercase fw-bold d-block">Articles</span>
        <h3 class="fw-bold mb-0 text-dark">{{ $stats['total_blogs'] }}</h3>
      </div>
      <div class="hm-admin-kpi-icon bg-secondary-subtle text-secondary">
        <i class="bi bi-newspaper"></i>
      </div>
    </div>
  </div>
</div>

{{-- Recent Commercial Inquiries & Contact Messages --}}
<div class="row g-4">
  {{-- Left: Commercial RFQs / Enquiries --}}
  <div class="col-lg-6">
    <div class="card border-0 shadow-sm rounded-3">
      <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0 h6"><i class="bi bi-file-earmark-text text-warning me-2"></i> Recent Commercial RFQs</h5>
        <a href="{{ route('admin.enquiries.index') }}" class="btn btn-sm btn-link text-decoration-none">View All</a>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-xs text-uppercase">
              <tr>
                <th>Item / Subject</th>
                <th>Client</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody class="text-sm">
              @forelse($recentEnquiries as $enq)
                <tr>
                  <td>
                    <strong class="d-block">{{ Str::limit($enq->item_name ?? 'Commercial Inquiry', 26) }}</strong>
                    <span class="text-xs text-muted text-uppercase">{{ $enq->type }}</span>
                  </td>
                  <td>
                    <div>{{ $enq->name }}</div>
                    <span class="text-xs text-muted">{{ $enq->company ?? $enq->email }}</span>
                  </td>
                  <td>
                    @if($enq->status === 'pending')
                      <span class="badge bg-warning text-dark text-xs">Pending</span>
                    @elseif($enq->status === 'in_review')
                      <span class="badge bg-info text-white text-xs">Reviewing</span>
                    @elseif($enq->status === 'contacted')
                      <span class="badge bg-primary text-xs">Contacted</span>
                    @elseif($enq->status === 'completed')
                      <span class="badge bg-success text-xs">Closed</span>
                    @else
                      <span class="badge bg-secondary text-xs">{{ $enq->status }}</span>
                    @endif
                  </td>
                  <td class="text-xs text-muted">{{ $enq->created_at->diffForHumans() }}</td>
                  <td>
                    <a href="{{ route('admin.enquiries.show', $enq->id) }}" class="btn btn-xs btn-outline-primary" style="padding: 2px 8px; font-size: 0.75rem;">
                      Review
                    </a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center py-4 text-muted">No commercial RFQs logged yet.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  {{-- Right: Recent Contact Messages --}}
  <div class="col-lg-6">
    <div class="card border-0 shadow-sm rounded-3">
      <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0 h6"><i class="bi bi-envelope text-danger me-2"></i> Recent Contact Dispatches</h5>
        <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-link text-decoration-none">View All</a>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-xs text-uppercase">
              <tr>
                <th>Sender</th>
                <th>Subject</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody class="text-sm">
              @forelse($recentMessages as $msg)
                <tr class="{{ !$msg->is_read ? 'table-warning bg-opacity-25' : '' }}">
                  <td>
                    <strong class="d-block">{{ $msg->name }}</strong>
                    <span class="text-xs text-muted">{{ $msg->email }}</span>
                  </td>
                  <td>{{ Str::limit($msg->subject ?? $msg->message, 30) }}</td>
                  <td>
                    @if(!$msg->is_read)
                      <span class="badge bg-danger text-xs">Unread</span>
                    @else
                      <span class="badge bg-secondary text-xs">Read</span>
                    @endif
                  </td>
                  <td class="text-xs text-muted">{{ $msg->created_at->diffForHumans() }}</td>
                  <td>
                    <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn btn-xs btn-outline-secondary" style="padding: 2px 8px; font-size: 0.75rem;">
                      Open
                    </a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center py-4 text-muted">No contact messages logged yet.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
