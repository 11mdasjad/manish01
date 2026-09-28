@extends('layouts.admin')

@section('title', 'Manage Partner Clients')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Institutional Clients & Alliances</h2>
    <p class="text-muted text-sm mb-0">Manage partner corporate logos displayed across the website footer and trust strips.</p>
  </div>
  <a href="{{ route('admin.clients.create') }}" class="btn btn-primary btn-sm">
    <i class="bi bi-plus-circle me-1"></i> Add Client / Partner
  </a>
</div>

<div class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light text-xs text-uppercase">
        <tr>
          <th>Partner Name</th>
          <th>Industry</th>
          <th>Website URL</th>
          <th>Order</th>
          <th>Status</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody class="text-sm">
        @forelse($clients as $client)
          <tr>
            <td>
              <strong class="text-dark">{{ $client->name }}</strong>
            </td>
            <td>
              <span class="badge bg-light text-dark border">{{ $client->industry ?? 'Enterprise' }}</span>
            </td>
            <td>
              @if($client->website_url)
                <a href="{{ $client->website_url }}" target="_blank" class="text-xs text-primary">{{ $client->website_url }}</a>
              @else
                -
              @endif
            </td>
            <td>{{ $client->order }}</td>
            <td>
              <span class="badge {{ $client->status ? 'bg-success' : 'bg-secondary' }}">
                {{ $client->status ? 'Active' : 'Disabled' }}
              </span>
            </td>
            <td class="text-end">
              <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-sm btn-outline-primary py-1 px-2">
                <i class="bi bi-pencil"></i>
              </a>
              <button type="button" class="btn btn-sm btn-outline-danger py-1 px-2" onclick="if(confirm('Delete client entry?')) { document.getElementById('delete-client-{{ $client->id }}').submit(); }">
                <i class="bi bi-trash"></i>
              </button>
              <form id="delete-client-{{ $client->id }}" action="{{ route('admin.clients.destroy', $client->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center py-4 text-muted">No client records found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
