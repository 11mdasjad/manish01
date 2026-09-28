<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <title>@yield('title', 'Executive Management Dashboard') | HarshMais Global</title>
  <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo.svg') }}">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{ asset('css/corporate-theme.css') }}?v=1.0.0">

  @stack('styles')
</head>
<body class="bg-light">

  {{-- Admin Sidebar --}}
  <aside class="hm-admin-sidebar" id="adminSidebar">
    <div class="p-3 border-bottom border-white-10 text-center">
      <a href="{{ route('admin.dashboard') }}">
        <img src="{{ asset('images/logo.png') }}" height="54" alt="Logo" class="rounded-2 shadow-sm">
      </a>
      <div class="mt-2 text-xs text-warning fw-bold text-uppercase letter-spacing-1">Executive Control Center</div>
    </div>

    <div class="py-3">
      <div class="px-3 pb-2 text-xs text-uppercase text-white-50 fw-bold">Overview</div>
      <a href="{{ route('admin.dashboard') }}" class="hm-admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
      </a>

      <div class="px-3 pt-3 pb-2 text-xs text-uppercase text-white-50 fw-bold">Properties & Catalog</div>
      <a href="{{ route('admin.products.index') }}" class="hm-admin-nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
        <i class="bi bi-houses"></i> Properties & Plots
      </a>
      <a href="{{ route('admin.services.index') }}" class="hm-admin-nav-item {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
        <i class="bi bi-shield-check"></i> Real Estate Services
      </a>
      <a href="{{ route('admin.categories.index') }}" class="hm-admin-nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
        <i class="bi bi-tags"></i> Categories
      </a>
      <a href="{{ route('admin.projects.index') }}" class="hm-admin-nav-item {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
        <i class="bi bi-buildings"></i> Projects & Layouts
      </a>

      <div class="px-3 pt-3 pb-2 text-xs text-uppercase text-white-50 fw-bold">Inquiries & Leads</div>
      <a href="{{ route('admin.enquiries.index') }}" class="hm-admin-nav-item {{ request()->routeIs('admin.enquiries.*') ? 'active' : '' }}">
        <i class="bi bi-file-earmark-text"></i> Property Enquiries
        @php $pendingCount = \App\Models\Enquiry::where('status', 'pending')->count(); @endphp
        @if($pendingCount > 0)
          <span class="badge bg-warning text-dark ms-auto text-xs">{{ $pendingCount }}</span>
        @endif
      </a>
      <a href="{{ route('admin.messages.index') }}" class="hm-admin-nav-item {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
        <i class="bi bi-envelope"></i> Contact Messages
        @php $unreadCount = \App\Models\ContactMessage::where('is_read', false)->count(); @endphp
        @if($unreadCount > 0)
          <span class="badge bg-danger ms-auto text-xs">{{ $unreadCount }}</span>
        @endif
      </a>

      <div class="px-3 pt-3 pb-2 text-xs text-uppercase text-white-50 fw-bold">Media & Editorial</div>
      <a href="{{ route('admin.blogs.index') }}" class="hm-admin-nav-item {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
        <i class="bi bi-newspaper"></i> Articles & News
      </a>
      <a href="{{ route('admin.gallery.index') }}" class="hm-admin-nav-item {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
        <i class="bi bi-images"></i> Media Gallery
      </a>
      <a href="{{ route('admin.team.index') }}" class="hm-admin-nav-item {{ request()->routeIs('admin.team.*') ? 'active' : '' }}">
        <i class="bi bi-people"></i> Board & Team
      </a>
      <a href="{{ route('admin.testimonials.index') }}" class="hm-admin-nav-item {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
        <i class="bi bi-chat-quote"></i> Testimonials
      </a>
      <a href="{{ route('admin.clients.index') }}" class="hm-admin-nav-item {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
        <i class="bi bi-briefcase"></i> Partner Clients
      </a>

      <div class="px-3 pt-3 pb-2 text-xs text-uppercase text-white-50 fw-bold">System Configuration</div>
      <a href="{{ route('admin.settings.index') }}" class="hm-admin-nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
        <i class="bi bi-sliders"></i> Website Settings
      </a>
      <a href="{{ route('admin.profile.edit') }}" class="hm-admin-nav-item {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
        <i class="bi bi-person-lock"></i> Profile & Security
      </a>
      <a href="{{ route('home') }}" target="_blank" class="hm-admin-nav-item text-warning">
        <i class="bi bi-box-arrow-up-right"></i> Live Corporate Site
      </a>
    </div>
  </aside>

  {{-- Admin Main Content Container --}}
  <div class="hm-admin-content">
    {{-- Topbar --}}
    <nav class="navbar navbar-expand navbar-light bg-white border-bottom px-4 py-2 sticky-top shadow-xs">
      <button class="btn btn-sm btn-outline-secondary d-lg-none me-2" type="button" onclick="document.getElementById('adminSidebar').classList.toggle('show')">
        <i class="bi bi-list fs-5"></i>
      </button>

      <div class="d-none d-md-block text-muted text-xs">
        <i class="bi bi-shield-lock-fill text-warning me-1"></i> Authenticated: <strong>{{ Auth::user()->name }}</strong> ({{ strtoupper(Auth::user()->role) }})
      </div>

      <div class="ms-auto d-flex align-items-center gap-3">
        <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-outline-primary d-none d-sm-inline-flex align-items-center gap-1">
          <i class="bi bi-globe"></i> View Site
        </a>

        <div class="dropdown">
          <button class="btn btn-light dropdown-toggle d-flex align-items-center gap-2 border" type="button" data-bs-toggle="dropdown">
            <img src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=0f172a&color=fff' }}" alt="Avatar" class="rounded-circle" width="28" height="28">
            <span class="text-sm fw-semibold">{{ Auth::user()->name }}</span>
          </button>
          <ul class="dropdown-menu dropdown-menu-end border shadow-sm">
            <li><a class="dropdown-item" href="{{ route('admin.profile.edit') }}"><i class="bi bi-person me-2"></i> Security Profile</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}"><i class="bi bi-sliders me-2"></i> Site Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item text-danger">
                  <i class="bi bi-box-arrow-right me-2"></i> Secure Logout
                </button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    {{-- Main Body --}}
    <main class="p-4 flex-grow-1">
      @include('components.alert')
      @yield('content')
    </main>

    {{-- Admin Footer --}}
    <footer class="p-3 bg-white border-top text-center text-xs text-muted">
      &copy; {{ date('Y') }} {{ \App\Models\Setting::get('site_name', 'HarshMais Global Enterprises') }} Executive Portal. Built for production excellence.
    </footer>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>
