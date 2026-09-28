@extends('layouts.admin')

@section('title', 'Read Message from ' . $message->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Corporate Dispatch #{{ str_pad($message->id, 5, '0', STR_PAD_LEFT) }}</h2>
    <p class="text-muted text-sm mb-0">Received on {{ $message->created_at->format('F d, Y \a\t h:i A') }}</p>
  </div>
  <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary btn-sm">
    <i class="bi bi-arrow-left me-1"></i> Back to Messages
  </a>
</div>

<div class="row g-4">
  <div class="col-lg-8">
    <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
      <div class="d-flex justify-content-between align-items-start border-bottom pb-3 mb-4">
        <div>
          <span class="text-xs text-muted text-uppercase fw-bold">Inquiry Subject</span>
          <h4 class="fw-bold mb-0 text-dark">{{ $message->subject ?? 'No Subject Specified' }}</h4>
        </div>
        <span class="badge {{ $message->is_read ? 'bg-secondary' : 'bg-success' }}">
          {{ $message->is_read ? 'Archived (Read)' : 'New' }}
        </span>
      </div>

      <div class="mb-4">
        <label class="text-xs text-muted text-uppercase fw-bold d-block mb-2">Message Body</label>
        <div class="p-4 bg-light rounded-3 text-slate-800 border" style="line-height: 1.8; font-size: 1rem; white-space: pre-wrap;">{{ $message->message }}</div>
      </div>

      <div class="d-flex gap-2">
        <a href="mailto:{{ $message->email }}?subject=Re: {{ urlencode($message->subject ?? 'Your HarshMais Inquiry') }}" class="hm-btn hm-btn-primary hm-btn-sm">
          <i class="bi bi-reply-fill"></i> Reply via Corporate Email
        </a>
        <form action="{{ route('admin.messages.toggle-read', $message->id) }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-check2"></i> Mark as {{ $message->is_read ? 'Unread' : 'Read' }}
          </button>
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
      <h5 class="fw-bold mb-3 border-bottom pb-2">Sender Information</h5>
      <ul class="list-unstyled text-sm text-slate-600 mb-0">
        <li class="mb-3">
          <span class="text-xs text-muted text-uppercase d-block fw-bold">Representative Name</span>
          <strong class="text-dark">{{ $message->name }}</strong>
        </li>
        <li class="mb-3">
          <span class="text-xs text-muted text-uppercase d-block fw-bold">Email Address</span>
          <a href="mailto:{{ $message->email }}" class="text-primary">{{ $message->email }}</a>
        </li>
        <li class="mb-3">
          <span class="text-xs text-muted text-uppercase d-block fw-bold">Phone Number</span>
          @if($message->phone)
            <a href="tel:{{ $message->phone }}" class="text-dark">{{ $message->phone }}</a>
          @else
            <span class="text-muted">Not provided</span>
          @endif
        </li>
        <li class="mb-3">
          <span class="text-xs text-muted text-uppercase d-block fw-bold">Company / Entity</span>
          <span>{{ $message->company ?? 'Individual Buyer / Investor' }}</span>
        </li>
        <li class="mb-0">
          <span class="text-xs text-muted text-uppercase d-block fw-bold">Originating IP</span>
          <code>{{ $message->ip_address ?? '127.0.0.1' }}</code>
        </li>
      </ul>
    </div>
  </div>
</div>
@endsection
