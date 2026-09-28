@extends('layouts.app')

@section('title', ($blog->meta_title ?? $blog->title) . ' | HarshMais Insights')
@section('meta_description', $blog->meta_description ?? Str::limit(strip_tags($blog->excerpt ?? $blog->content), 160))
@section('og_image', $blog->image_url)

@section('schema')
<script type="application/ld+json">
{
  "{{ '@context' }}": "https://schema.org",
  "@type": "Article",
  "headline": "{{ $blog->title }}",
  "image": "{{ $blog->image_url }}",
  "datePublished": "{{ $blog->published_at ? $blog->published_at->toIso8601String() : now()->toIso8601String() }}",
  "author": {
    "@type": "Person",
    "name": "{{ $blog->author_name }}"
  },
  "publisher": {
    "@type": "Organization",
    "name": "HarshMais Global Enterprises",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ asset('images/logo.svg') }}"
    }
  },
  "description": "{{ $blog->meta_description ?? Str::limit(strip_tags($blog->excerpt), 200) }}"
}
</script>
@endsection

@section('content')
<x-breadcrumb 
  :title="$blog->title" 
  :subtitle="'Published ' . ($blog->published_at ? $blog->published_at->format('M d, Y') : '') . ' • ' . $blog->reading_time"
  :items="[
    'Insights' => route('blog.index'),
    $blog->title => route('blog.show', $blog->slug)
  ]" 
/>

<section class="hm-section bg-slate-50">
  <div class="container">
    <div class="row g-4 g-lg-5">
      {{-- Main Article Body --}}
      <div class="col-lg-8">
        <article class="bg-white p-4 p-md-5 rounded-4 shadow-sm border mb-5">
          <div class="rounded-3 overflow-hidden mb-4" style="aspect-ratio: 16/9;">
            <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="w-100 h-100 object-fit-cover">
          </div>

          <div class="d-flex flex-wrap align-items-center gap-3 text-xs text-muted mb-4 pb-3 border-bottom">
            <span><i class="bi bi-person-fill text-warning me-1"></i> {{ $blog->author_name }}</span>
            <span>•</span>
            <span><i class="bi bi-calendar-event me-1"></i> {{ $blog->published_at ? $blog->published_at->format('F d, Y') : '' }}</span>
            <span>•</span>
            <span><i class="bi bi-clock me-1"></i> {{ $blog->reading_time }}</span>
            @if($blog->category)
              <span class="badge bg-primary text-uppercase">{{ $blog->category->name }}</span>
            @endif
          </div>

          {{-- Article HTML Content --}}
          <div class="article-content text-slate-700" style="font-size: 1.05rem; line-height: 1.85;">
            {!! $blog->content !!}
          </div>

          {{-- Tags --}}
          @if(!empty($blog->tags) && is_array($blog->tags))
            <div class="mt-5 pt-4 border-top">
              <span class="text-xs text-muted text-uppercase fw-bold d-block mb-2">Filed Under:</span>
              <div class="d-flex flex-wrap gap-2">
                @foreach($blog->tags as $t)
                  <span class="badge bg-light text-dark border px-3 py-2">#{{ $t }}</span>
                @endforeach
              </div>
            </div>
          @endif
        </article>

        {{-- Author Bio Card --}}
        <div class="p-4 bg-white rounded-4 border shadow-sm d-flex gap-4 align-items-center mb-5">
          <div class="hm-service-icon bg-primary text-white flex-shrink-0 mb-0" style="width: 60px; height: 60px; font-size: 1.5rem;">
            <i class="bi bi-pen-fill"></i>
          </div>
          <div>
            <h5 class="fw-bold mb-1">{{ $blog->author_name }}</h5>
            <span class="text-xs text-muted d-block mb-2">HarshMais Global Corporate Editorial Board</span>
            <p class="text-xs text-slate-600 mb-0">Providing regular analysis on international agricultural trade agreements, port logistics, supply chain decarbonization, and commercial property jurisprudence.</p>
          </div>
        </div>
      </div>

      {{-- Sidebar --}}
      <div class="col-lg-4">
        {{-- Recent Posts --}}
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
          <h5 class="fw-bold mb-3 border-bottom pb-2">Related Articles</h5>
          <div class="d-flex flex-column gap-3">
            @foreach($relatedBlogs as $rb)
              <div class="d-flex gap-3 align-items-center">
                <img src="{{ $rb->image_url }}" alt="{{ $rb->title }}" class="rounded" style="width: 65px; height: 65px; object-fit: cover; flex-shrink: 0;">
                <div>
                  <h6 class="mb-1 text-sm fw-bold">
                    <a href="{{ route('blog.show', $rb->slug) }}" class="text-dark text-decoration-none">
                      {{ Str::limit($rb->title, 55) }}
                    </a>
                  </h6>
                  <span class="text-xs text-muted">{{ $rb->published_at ? $rb->published_at->format('M d, Y') : '' }}</span>
                </div>
              </div>
            @endforeach
          </div>
        </div>

        {{-- Corporate Newsletter / RFQ Promo --}}
        <div class="p-4 bg-dark text-white rounded-4 shadow-sm text-center">
          <i class="bi bi-envelope-check text-warning fs-1 d-block mb-2"></i>
          <h5 class="fw-bold text-white mb-2">Global Trade Advisory</h5>
          <p class="text-xs text-slate-300 mb-3">Subscribe to our monthly institutional market intelligence bulletins or speak directly with our trade desk.</p>
          <button class="hm-btn hm-btn-gold w-100 hm-btn-sm" data-bs-toggle="modal" data-bs-target="#enquiryModal">
            Inquire Trade Services
          </button>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
