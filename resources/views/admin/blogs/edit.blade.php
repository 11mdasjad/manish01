@extends('layouts.admin')

@section('title', 'Edit Article: ' . $blog->title)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Edit Article: {{ Str::limit($blog->title, 40) }}</h2>
    <p class="text-muted text-sm mb-0">Update text, tags, cover visual, and publication state.</p>
  </div>
  <div class="d-flex gap-2">
    <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" class="btn btn-outline-primary btn-sm">
      <i class="bi bi-eye me-1"></i> View Live
    </a>
    <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary btn-sm">
      <i class="bi bi-arrow-left me-1"></i> Back to Articles
    </a>
  </div>
</div>

<form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Article Content</h5>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Headline / Title <span class="text-danger">*</span></label>
          <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label text-xs fw-bold">Category</label>
            <select name="blog_category_id" class="form-select">
              <option value="">Select Category</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('blog_category_id', $blog->blog_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label text-xs fw-bold">Reading Time</label>
            <input type="text" name="reading_time" class="form-control" value="{{ old('reading_time', $blog->reading_time) }}">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Excerpt / Executive Teaser</label>
          <textarea name="excerpt" rows="2" class="form-control">{{ old('excerpt', $blog->excerpt) }}</textarea>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Full Article HTML / Markdown Content <span class="text-danger">*</span></label>
          <textarea name="content" rows="12" class="form-control" required>{{ old('content', $blog->content) }}</textarea>
        </div>

        @php
          $tagsText = is_array($blog->tags) ? implode(', ', $blog->tags) : '';
        @endphp

        <div class="mb-0">
          <label class="form-label text-xs fw-bold">Tags (Comma-separated)</label>
          <input type="text" name="tags_text" class="form-control" value="{{ old('tags_text', $tagsText) }}">
        </div>
      </div>

      {{-- SEO --}}
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Search Engine Optimization</h5>
        <div class="mb-3">
          <label class="form-label text-xs fw-bold">SEO Title</label>
          <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $blog->meta_title) }}">
        </div>
        <div class="mb-0">
          <label class="form-label text-xs fw-bold">Meta Description</label>
          <textarea name="meta_description" rows="2" class="form-control">{{ old('meta_description', $blog->meta_description) }}</textarea>
        </div>
      </div>
    </div>

    {{-- Right Sidebar --}}
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Cover Visual</h5>
        <div class="mb-3 text-center">
          <img src="{{ $blog->image_url }}" alt="Cover" class="img-fluid rounded border mb-2" style="max-height: 160px;">
          <span class="text-xs text-muted d-block">Current Active Visual</span>
        </div>
        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Replace with Local File</label>
          <input type="file" name="featured_image_file" class="form-control form-control-sm" accept="image/*">
        </div>
        <div class="text-center text-xs text-muted my-2">OR</div>
        <div class="mb-0">
          <label class="form-label text-xs fw-bold">Direct Image Web URL</label>
          <input type="url" name="featured_image_url" class="form-control form-control-sm" value="{{ old('featured_image_url') }}" placeholder="https://...">
        </div>
      </div>

      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Publishing Workflow</h5>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Author Attribution</label>
          <input type="text" name="author_name" class="form-control form-control-sm" value="{{ old('author_name', $blog->author_name) }}">
        </div>

        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" name="is_published" id="blogPublished" value="1" {{ old('is_published', $blog->is_published) ? 'checked' : '' }}>
          <label class="form-check-label text-sm fw-bold" for="blogPublished">Published Live</label>
        </div>

        <div class="form-check form-switch mb-4">
          <input class="form-check-input" type="checkbox" name="is_featured" id="blogFeatured" value="1" {{ old('is_featured', $blog->is_featured) ? 'checked' : '' }}>
          <label class="form-check-label text-sm fw-bold" for="blogFeatured">Promote as Lead Insight</label>
        </div>

        <button type="submit" class="hm-btn hm-btn-primary w-100 fw-bold">
          <i class="bi bi-check-circle me-1"></i> Update Article
        </button>
      </div>
    </div>
  </div>
</form>
@endsection
