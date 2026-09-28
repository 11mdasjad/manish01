{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  {{-- Static Core Pages --}}
  <url>
    <loc>{{ route('home') }}</loc>
    <changefreq>daily</changefreq>
    <priority>1.0</priority>
  </url>
  <url>
    <loc>{{ route('about') }}</loc>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>{{ route('products.index') }}</loc>
    <changefreq>daily</changefreq>
    <priority>0.9</priority>
  </url>
  <url>
    <loc>{{ route('services.index') }}</loc>
    <changefreq>weekly</changefreq>
    <priority>0.9</priority>
  </url>
  <url>
    <loc>{{ route('projects.index') }}</loc>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>{{ route('team.index') }}</loc>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
  </url>
  <url>
    <loc>{{ route('gallery.index') }}</loc>
    <changefreq>weekly</changefreq>
    <priority>0.7</priority>
  </url>
  <url>
    <loc>{{ route('blog.index') }}</loc>
    <changefreq>daily</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>{{ route('contact.index') }}</loc>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>{{ route('legal.privacy') }}</loc>
    <changefreq>yearly</changefreq>
    <priority>0.3</priority>
  </url>
  <url>
    <loc>{{ route('legal.terms') }}</loc>
    <changefreq>yearly</changefreq>
    <priority>0.3</priority>
  </url>

  {{-- Dynamic Products --}}
  @foreach($products as $product)
    <url>
      <loc>{{ route('products.show', $product->slug) }}</loc>
      <lastmod>{{ $product->updated_at->toAtomString() }}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.8</priority>
    </url>
  @endforeach

  {{-- Dynamic Services --}}
  @foreach($services as $service)
    <url>
      <loc>{{ route('services.show', $service->slug) }}</loc>
      <lastmod>{{ $service->updated_at->toAtomString() }}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.8</priority>
    </url>
  @endforeach

  {{-- Dynamic Projects --}}
  @foreach($projects as $project)
    <url>
      <loc>{{ route('projects.show', $project->slug) }}</loc>
      <lastmod>{{ $project->updated_at->toAtomString() }}</lastmod>
      <changefreq>monthly</changefreq>
      <priority>0.7</priority>
    </url>
  @endforeach

  {{-- Dynamic Blogs --}}
  @foreach($blogs as $blog)
    <url>
      <loc>{{ route('blog.show', $blog->slug) }}</loc>
      <lastmod>{{ ($blog->published_at ?? $blog->updated_at)->toAtomString() }}</lastmod>
      <changefreq>monthly</changefreq>
      <priority>0.7</priority>
    </url>
  @endforeach
</urlset>
