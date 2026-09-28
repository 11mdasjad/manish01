@extends('layouts.admin')

@section('title', 'Website Settings & Configuration')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="h3 fw-bold mb-1">Corporate Website Settings</h2>
    <p class="text-muted text-sm mb-0">Update contact lines, branch locations, statistics, social media, and default SEO tags without touching code.</p>
  </div>
</div>

<div class="card border-0 shadow-sm rounded-3 bg-white overflow-hidden">
  {{-- Settings Group Tabs --}}
  <div class="card-header bg-white border-bottom p-0">
    <ul class="nav nav-tabs border-0" id="settingsTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link py-3 px-4 fw-bold {{ $group === 'general' ? 'active text-primary' : 'text-slate-600' }}" href="{{ route('admin.settings.index', ['group' => 'general']) }}">
          <i class="bi bi-sliders me-1"></i> General
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link py-3 px-4 fw-bold {{ $group === 'contact' ? 'active text-primary' : 'text-slate-600' }}" href="{{ route('admin.settings.index', ['group' => 'contact']) }}">
          <i class="bi bi-geo-alt me-1"></i> Contact & Branches
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link py-3 px-4 fw-bold {{ $group === 'stats' ? 'active text-primary' : 'text-slate-600' }}" href="{{ route('admin.settings.index', ['group' => 'stats']) }}">
          <i class="bi bi-bar-chart me-1"></i> Statistics Counters
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link py-3 px-4 fw-bold {{ $group === 'social' ? 'active text-primary' : 'text-slate-600' }}" href="{{ route('admin.settings.index', ['group' => 'social']) }}">
          <i class="bi bi-share me-1"></i> Social Media
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link py-3 px-4 fw-bold {{ $group === 'seo' ? 'active text-primary' : 'text-slate-600' }}" href="{{ route('admin.settings.index', ['group' => 'seo']) }}">
          <i class="bi bi-search me-1"></i> Default SEO
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link py-3 px-4 fw-bold {{ $group === 'appearance' ? 'active text-primary' : 'text-slate-600' }}" href="{{ route('admin.settings.index', ['group' => 'appearance']) }}">
          <i class="bi bi-palette me-1"></i> Hero Text
        </a>
      </li>
    </ul>
  </div>

  {{-- Settings Form --}}
  <div class="card-body p-4 p-md-5">
    <form action="{{ route('admin.settings.update') }}" method="POST">
      @csrf
      <input type="hidden" name="group" value="{{ $group }}">

      <div class="row g-4 max-w-4xl">
        @forelse($settings as $s)
          <div class="col-12">
            <label class="form-label text-xs fw-bold text-dark text-uppercase">
              {{ $s->label ?? ucwords(str_replace('_', ' ', $s->key)) }}
            </label>
            @if($s->type === 'textarea')
              <textarea name="{{ $s->key }}" rows="3" class="form-control">{{ old($s->key, $s->value) }}</textarea>
            @else
              <input type="text" name="{{ $s->key }}" class="form-control" value="{{ old($s->key, $s->value) }}">
            @endif
            <span class="text-xs text-muted">Key: <code>{{ $s->key }}</code></span>
          </div>
        @empty
          <div class="col-12 text-center py-4 text-muted">No configuration fields defined for this section.</div>
        @endforelse

        <div class="col-12 pt-3">
          <button type="submit" class="hm-btn hm-btn-primary fw-bold">
            <i class="bi bi-check2-circle me-1"></i> Save {{ ucfirst($group) }} Settings
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
