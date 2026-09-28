@extends('layouts.admin')

@section('title', 'Manage Editorial Insights & Blogs')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Corporate Insights & News</h2>
    <p class="text-muted text-sm mb-0">Publish research briefings, market trends, and executive leadership articles.</p>
  </div>
  <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm">
    <i class="bi bi-pencil-square me-1"></i> Write New Article
  </a>
</div>

{{-- Filters --}}
<div class="card border-0 shadow-sm rounded-3 mb-4 p-3 bg-white">
  <form action="{{ route('admin.blogs.index') }}" method="GET" class="row g-2 align-items-center">
    <div class="col-md-6">
      <input type="text" name="search" class="form-control form-control-sm" placeholder="Search title..." value="{{ request('search') }}">
    </div>
    <div class="col-md-4">
      <select name="category_id" class="form-select form-select-sm">
        <option value="">All Categories</option>
        @foreach($categories as $cat)
          <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
        @endforeach
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
          <th style="width: 60px;">Image</th>
          <th>Article Title</th>
          <th>Category</th>
          <th>Author</th>
          <th>State</th>
          <th>Published Date</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody class="text-sm">
        @forelse($blogs as $blog)
          <tr>
            <td>
              <img src="{{ $blog->image_url }}" alt="Article" class="rounded border" style="width: 48px; height: 48px; object-fit: cover;">
            </td>
            <td>
              <strong class="d-block text-dark">{{ $blog->title }}</strong>
              <span class="text-xs text-muted">{{ $blog->reading_time }}</span>
            </td>
            <td>
              <span class="badge bg-light text-dark border">{{ $blog->category->name ?? 'Corporate' }}</span>
            </td>
            <td class="text-xs">{{ $blog->author_name }}</td>
            <td>
              <span class="badge {{ $blog->is_published ? 'bg-success' : 'bg-secondary' }}">
                {{ $blog->is_published ? 'Published' : 'Draft' }}
              </span>
            </td>
            <td class="text-xs text-muted">{{ $blog->published_at ? $blog->published_at->format('M d, Y') : '-' }}</td>
            <td class="text-end">
              <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" class="btn btn-sm btn-outline-secondary py-1 px-2" title="View Article">
                <i class="bi bi-eye"></i>
              </a>
              <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-outline-primary py-1 px-2" title="Edit Article">
                <i class="bi bi-pencil"></i>
              </a>
              <button type="button" class="btn btn-sm btn-outline-danger py-1 px-2" onclick="if(confirm('Delete article?')) { document.getElementById('delete-blog-{{ $blog->id }}').submit(); }">
                <i class="bi bi-trash"></i>
              </button>
              <form id="delete-blog-{{ $blog->id }}" action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="text-center py-5 text-muted">No published articles or news found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($blogs->hasPages())
    <div class="card-footer bg-white py-3">
      {{ $blogs->links('pagination::bootstrap-5') }}
    </div>
  @endif
</div>
@endsection
