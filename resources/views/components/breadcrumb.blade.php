@props([
  'title' => 'Corporate Page',
  'subtitle' => null,
  'items' => []
])

<div class="hm-breadcrumb-wrap">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <h1 class="fw-extrabold mb-2">{{ $title }}</h1>
        @if($subtitle)
          <p class="lead text-slate-300 mb-0">{{ $subtitle }}</p>
        @endif
      </div>
      <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb justify-content-lg-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house-door me-1"></i> Home</a></li>
            @foreach($items as $label => $url)
              @if(!$loop->last)
                <li class="breadcrumb-item"><a href="{{ $url }}">{{ $label }}</a></li>
              @else
                <li class="breadcrumb-item active" aria-current="page">{{ $label }}</li>
              @endif
            @endforeach
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>
