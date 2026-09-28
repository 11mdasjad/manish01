@extends('layouts.admin')

@section('title', 'Manage Testimonials')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Client Testimonials & Reviews</h2>
    <p class="text-muted text-sm mb-0">Manage feedback from global commodity buyers and institutional investors.</p>
  </div>
  <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary btn-sm">
    <i class="bi bi-plus-circle me-1"></i> Add Testimonial
  </a>
</div>

<div class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light text-xs text-uppercase">
        <tr>
          <th>Client Name</th>
          <th>Designation & Company</th>
          <th>Rating</th>
          <th>Feedback Quote</th>
          <th>Status</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody class="text-sm">
        @forelse($testimonials as $test)
          <tr>
            <td>
              <strong class="text-dark">{{ $test->client_name }}</strong>
            </td>
            <td>
              <span class="d-block">{{ $test->client_title ?? '-' }}</span>
              <span class="text-xs text-muted">{{ $test->company }}</span>
            </td>
            <td>
              <span class="text-warning">
                @for($i = 0; $i < $test->rating; $i++) ★ @endfor
              </span>
            </td>
            <td>{{ Str::limit($test->content, 60) }}</td>
            <td>
              <span class="badge {{ $test->status ? 'bg-success' : 'bg-secondary' }}">
                {{ $test->status ? 'Published' : 'Hidden' }}
              </span>
            </td>
            <td class="text-end">
              <a href="{{ route('admin.testimonials.edit', $test->id) }}" class="btn btn-sm btn-outline-primary py-1 px-2">
                <i class="bi bi-pencil"></i>
              </a>
              <button type="button" class="btn btn-sm btn-outline-danger py-1 px-2" onclick="if(confirm('Delete review?')) { document.getElementById('delete-test-{{ $test->id }}').submit(); }">
                <i class="bi bi-trash"></i>
              </button>
              <form id="delete-test-{{ $test->id }}" action="{{ route('admin.testimonials.destroy', $test->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center py-4 text-muted">No testimonials recorded.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
