@extends('layouts.admin')

@section('title', 'Write New Article')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Compose Corporate Article</h2>
    <p class="text-muted text-sm mb-0">Publish technical insights, port trade reports, and ESG updates.</p>
  </div>
  <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary btn-sm">
    <i class="bi bi-arrow-left me-1"></i> Back to Articles
  </a>
</div>

<form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Article Content</h5>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Headline / Title <span class="text-danger">*</span></label>
          <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="e.g. Navigating Global Agro Supply Chains: The Strategic Role of Eastern Indian Ports" required>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label text-xs fw-bold">Category</label>
            <select name="blog_category_id" class="form-select">
              <option value="">Select Category</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('blog_category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label text-xs fw-bold">Reading Time</label>
            <input type="text" name="reading_time" class="form-control" value="{{ old('reading_time', '5 min read') }}">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Excerpt / Executive Teaser</label>
          <textarea name="excerpt" rows="2" class="form-control" placeholder="1-2 sentences summarizing key conclusions...">{{ old('excerpt') }}</textarea>
        </div>

        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Full Article HTML / Markdown Content <span class="text-danger">*</span></label>
          <textarea name="content" rows="12" class="form-control" placeholder="<p>Full article body with headings, blockquotes, and lists...</p>" required>{{ old('content') }}</textarea>
        </div>

        <div class="mb-0">
          <label class="form-label text-xs fw-bold">Tags (Comma-separated)</label>
          <input type="text" name="tags_text" class="form-control" value="{{ old('tags_text') }}" placeholder="Agro Trade, Supply Chain, Logistics, Export">
        </div>
      </div>

      {{-- SEO --}}
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Search Engine Optimization</h5>
        <div class="mb-3">
          <label class="form-label text-xs fw-bold">SEO Title</label>
          <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}">
        </div>
        <div class="mb-0">
          <label class="form-label text-xs fw-bold">Meta Description</label>
          <textarea name="meta_description" rows="2" class="form-control">{{ old('meta_description') }}</textarea>
        </div>
      </div>
    </div>

    {{-- Right Sidebar --}}
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Cover Visual</h5>
        <div class="mb-3">
          <label class="form-label text-xs fw-bold">Upload Local Image</label>
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
          <input type="text" name="author_name" class="form-control form-control-sm" value="{{ old('author_name', 'HarshMais Corporate') }}">
        </div>

        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" name="is_published" id="blogPublished" checked value="1">
          <label class="form-check-label text-sm fw-bold" for="blogPublished">Publish Immediately</label>
        </div>

        <div class="form-check form-switch mb-4">
          <input class="form-check-input" type="checkbox" name="is_featured" id="blogFeatured" value="1">
          <label class="form-check-label text-sm fw-bold" for="blogFeatured">Promote as Lead Insight</label>
        </div>

        <button type="submit" class="hm-btn hm-btn-primary w-100 fw-bold">
          <i class="bi bi-send me-1"></i> Publish Article
        </button>
      </div>
    </div>
  </div>
</form>
@endsection
