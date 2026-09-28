@extends('layouts.admin')

@section('title', 'Manage Contact Messages')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Corporate Contact Inquiries</h2>
    <p class="text-muted text-sm mb-0">Review communications received through the official contact portal.</p>
  </div>
  <div class="d-flex gap-2">
    <a href="{{ route('admin.messages.index', ['status' => 'unread']) }}" class="btn btn-sm btn-outline-danger">
      Unread Only
    </a>
    <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-secondary">
      All Messages
    </a>
  </div>
</div>

<div class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light text-xs text-uppercase">
        <tr>
          <th>Sender Details</th>
          <th>Subject / Topic</th>
          <th>Status</th>
          <th>Received At</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody class="text-sm">
        @forelse($messages as $msg)
          <tr class="{{ !$msg->is_read ? 'table-warning bg-opacity-25' : '' }}">
            <td>
              <strong class="d-block text-dark">{{ $msg->name }}</strong>
              <span class="text-xs text-muted d-block">{{ $msg->email }}</span>
              @if($msg->phone)
                <span class="text-xs text-primary">{{ $msg->phone }}</span>
              @endif
            </td>
            <td>
              <strong class="d-block text-dark">{{ $msg->subject ?? 'General Inquiry' }}</strong>
              <span class="text-xs text-muted">{{ Str::limit($msg->message, 50) }}</span>
            </td>
            <td>
              <span class="badge {{ $msg->is_read ? 'bg-secondary' : 'bg-danger' }}">
                {{ $msg->is_read ? 'Read' : 'Unread' }}
              </span>
            </td>
            <td class="text-xs text-muted">
              {{ $msg->created_at->format('M d, Y h:i A') }}
              <span class="d-block">{{ $msg->created_at->diffForHumans() }}</span>
            </td>
            <td class="text-end">
              <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn btn-sm btn-primary py-1 px-2" title="Read Full Message">
                <i class="bi bi-envelope-open"></i> Read
              </a>
              <button type="button" class="btn btn-sm btn-outline-danger py-1 px-2" onclick="if(confirm('Delete message record?')) { document.getElementById('del-msg-{{ $msg->id }}').submit(); }">
                <i class="bi bi-trash"></i>
              </button>
              <form id="del-msg-{{ $msg->id }}" action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center py-5 text-muted">No contact inquiries found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($messages->hasPages())
    <div class="card-footer bg-white py-3">
      {{ $messages->links('pagination::bootstrap-5') }}
    </div>
  @endif
</div>
@endsection
