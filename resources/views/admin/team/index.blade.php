@extends('layouts.admin')

@section('title', 'Manage Leadership Board & Team')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Corporate Leadership & Board</h2>
    <p class="text-muted text-sm mb-0">Manage governing board members, executive directors, and technical heads.</p>
  </div>
  <a href="{{ route('admin.team.create') }}" class="btn btn-primary btn-sm">
    <i class="bi bi-person-plus me-1"></i> Add Team Member
  </a>
</div>

<div class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light text-xs text-uppercase">
        <tr>
          <th style="width: 60px;">Photo</th>
          <th>Name</th>
          <th>Designation</th>
          <th>Department</th>
          <th>Email</th>
          <th>Order</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody class="text-sm">
        @forelse($members as $m)
          <tr>
            <td>
              <img src="{{ $m->image_url }}" alt="{{ $m->name }}" class="rounded-circle border" style="width: 44px; height: 44px; object-fit: cover;">
            </td>
            <td>
              <strong class="text-dark">{{ $m->name }}</strong>
            </td>
            <td>{{ $m->designation }}</td>
            <td>
              <span class="badge bg-light text-dark border">{{ $m->department }}</span>
            </td>
            <td>{{ $m->email ?? '-' }}</td>
            <td>{{ $m->order }}</td>
            <td class="text-end">
              <a href="{{ route('admin.team.edit', $m->id) }}" class="btn btn-sm btn-outline-primary py-1 px-2" title="Edit">
                <i class="bi bi-pencil"></i>
              </a>
              <button type="button" class="btn btn-sm btn-outline-danger py-1 px-2" onclick="if(confirm('Delete team member profile?')) { document.getElementById('delete-member-{{ $m->id }}').submit(); }">
                <i class="bi bi-trash"></i>
              </button>
              <form id="delete-member-{{ $m->id }}" action="{{ route('admin.team.destroy', $m->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="text-center py-4 text-muted">No team members recorded.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
