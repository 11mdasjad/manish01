@extends('layouts.app')

@section('title', 'Corporate Insights & Market Intelligence | HarshMais Global')
@section('meta_description', 'Thought leadership and updates on agricultural trade policies, bulk shipping, industrial warehousing engineering, and land investment.')

@section('content')
<x-breadcrumb 
  title="Corporate Insights & News" 
  subtitle="Strategic Perspectives on Global Agro-Trade, Maritime Ports, Modern Warehousing & Agrarian Law"
  :items="['Insights' => route('blog.index')]" 
/>

<section class="hm-section bg-slate-50">
  <div class="container">
    {{-- Featured Post Banner --}}
    @if($featuredBlog && !request()->hasAny(['search', 'category']))
      <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-5 bg-white">
        <div class="row g-0">
          <div class="col-lg-7">
            <div class="h-100" style="min-height: 380px;">
              <img src="{{ $featuredBlog->image_url }}" alt="{{ $featuredBlog->title }}" class="w-100 h-100 object-fit-cover">
            </div>
          </div>
          <div class="col-lg-5 p-4 p-md-5 d-flex flex-column justify-content-center">
            <div>
              <span class="badge bg-warning text-dark text-uppercase fw-bold mb-2">Featured Insight</span>
              @if($featuredBlog->category)
                <span class="badge bg-light text-dark border ms-1">{{ $featuredBlog->category->name }}</span>
              @endif
              <div class="text-xs text-muted mb-2">
                <i class="bi bi-clock me-1"></i> {{ $featuredBlog->reading_time }} • {{ $featuredBlog->published_at ? $featuredBlog->published_at->format('M d, Y') : '' }}
              </div>
              <h2 class="fw-bold mb-3 h3">
                <a href="{{ route('blog.show', $featuredBlog->slug) }}" class="text-dark text-decoration-none">
                  {{ $featuredBlog->title }}
                </a>
              </h2>
              <p class="text-slate-600 mb-4">{{ $featuredBlog->excerpt }}</p>
              <a href="{{ route('blog.show', $featuredBlog->slug) }}" class="hm-btn hm-btn-primary hm-btn-sm align-self-start">
                Read Full Analysis <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    @endif

    {{-- Main Articles Content with Sidebar --}}
    <div class="row g-4 g-lg-5">
      {{-- Articles List --}}
      <div class="col-lg-8">
        @if($blogs->isEmpty())
          <div class="text-center py-5 bg-white rounded-3 border">
            <i class="bi bi-journal-x fs-1 text-muted d-block mb-3"></i>
            <h4 class="fw-bold">No Articles Found</h4>
            <p class="text-muted">No insight publications matched your search criteria.</p>
            <a href="{{ route('blog.index') }}" class="hm-btn hm-btn-primary hm-btn-sm">Reset Filters</a>
          </div>
        @else
          <div class="row g-4">
            @foreach($blogs as $b)
              <div class="col-md-6">
                <div class="hm-card">
                  <div class="hm-card-img-wrap">
                    <img src="{{ $b->image_url }}" alt="{{ $b->title }}" loading="lazy">
                    @if($b->category)
                      <span class="hm-card-badge">{{ $b->category->name }}</span>
                    @endif
                  </div>
                  <div class="hm-card-body">
                    <div class="d-flex align-items-center gap-2 text-xs text-muted mb-2">
                      <span><i class="bi bi-calendar3"></i> {{ $b->published_at ? $b->published_at->format('M d, Y') : '' }}</span>
                      <span>•</span>
                      <span><i class="bi bi-clock"></i> {{ $b->reading_time }}</span>
                    </div>

                    <h3 class="hm-card-title h5">
                      <a href="{{ route('blog.show', $b->slug) }}">{{ $b->title }}</a>
                    </h3>

                    <p class="hm-card-desc">{{ Str::limit($b->excerpt, 110) }}</p>

                    <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                      <span class="text-xs text-muted">By {{ $b->author_name }}</span>
                      <a href="{{ route('blog.show', $b->slug) }}" class="text-primary fw-bold text-sm text-decoration-none">
                        Read <i class="bi bi-arrow-right text-xs"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>

          {{-- Pagination --}}
          <div class="d-flex justify-content-center mt-5">
            {{ $blogs->links('pagination::bootstrap-5') }}
          </div>
        @endif
      </div>

      {{-- Sidebar --}}
      <div class="col-lg-4">
        {{-- Search Widget --}}
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
          <h5 class="fw-bold mb-3">Search Publications</h5>
          <form action="{{ route('blog.index') }}" method="GET">
            <div class="input-group">
              <input type="text" name="search" class="form-control" placeholder="Search keywords..." value="{{ request('search') }}">
              <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
            </div>
          </form>
        </div>

        {{-- Categories Widget --}}
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
          <h5 class="fw-bold mb-3 border-bottom pb-2">Topic Categories</h5>
          <ul class="list-unstyled mb-0">
            <li class="mb-2">
              <a href="{{ route('blog.index') }}" class="d-flex justify-content-between text-decoration-none {{ !request('category') ? 'fw-bold text-primary' : 'text-slate-700' }}">
                <span>All Insight Topics</span>
                <span class="badge bg-light text-dark border">{{ $categories->sum('blogs_count') }}</span>
              </a>
            </li>
            @foreach($categories as $cat)
              <li class="mb-2">
                <a href="{{ route('blog.index', ['category' => $cat->slug]) }}" class="d-flex justify-content-between text-decoration-none {{ request('category') == $cat->slug ? 'fw-bold text-primary' : 'text-slate-700' }}">
                  <span>{{ $cat->name }}</span>
                  <span class="badge bg-light text-dark border">{{ $cat->blogs_count }}</span>
                </a>
              </li>
            @endforeach
          </ul>
        </div>

        {{-- Recent Posts Widget --}}
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
          <h5 class="fw-bold mb-3 border-bottom pb-2">Recent Publications</h5>
          <div class="d-flex flex-column gap-3">
            @foreach($recentPosts as $rp)
              <div class="d-flex gap-3 align-items-center">
                <img src="{{ $rp->image_url }}" alt="{{ $rp->title }}" class="rounded" style="width: 65px; height: 65px; object-fit: cover; flex-shrink: 0;">
                <div>
                  <h6 class="mb-1 text-sm fw-bold">
                    <a href="{{ route('blog.show', $rp->slug) }}" class="text-dark text-decoration-none">
                      {{ Str::limit($rp->title, 55) }}
                    </a>
                  </h6>
                  <span class="text-xs text-muted">{{ $rp->published_at ? $rp->published_at->format('M d, Y') : '' }}</span>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
