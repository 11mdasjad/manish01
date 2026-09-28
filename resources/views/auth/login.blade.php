<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <title>Executive Portal Authentication | HarshMais Global</title>
  <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo.svg') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{ asset('css/corporate-theme.css') }}">
</head>
<body class="bg-dark d-flex align-items-center justify-content-center min-vh-100" style="background: radial-gradient(circle at center, #0f2b48 0%, #060e1a 100%) !important;">

  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="card border-0 shadow-2xl rounded-4 p-4 p-md-5 bg-white text-dark position-relative">
          {{-- Logo Header --}}
          <div class="text-center mb-4 pb-2 border-bottom">
            <a href="{{ route('home') }}">
              <img src="{{ asset('images/logo.png') }}" height="64" alt="Logo" class="mb-3 rounded-2 shadow-sm">
            </a>
            <h4 class="fw-bold mb-1">Executive Portal</h4>
            <span class="text-xs text-muted text-uppercase fw-semibold letter-spacing-1">Secure Management Clearance</span>
          </div>

          {{-- Session Alerts --}}
          @if(session('error'))
            <div class="alert alert-danger py-2 text-xs d-flex align-items-center mb-3">
              <i class="bi bi-exclamation-triangle-fill me-2 fs-6"></i>
              <div>{{ session('error') }}</div>
            </div>
          @endif
          @if(session('success'))
            <div class="alert alert-success py-2 text-xs d-flex align-items-center mb-3">
              <i class="bi bi-check-circle-fill me-2 fs-6"></i>
              <div>{{ session('success') }}</div>
            </div>
          @endif

          {{-- Login Form --}}
          <form action="{{ route('admin.login.submit') }}" method="POST" autocomplete="off">
            @csrf

            <div class="mb-3">
              <label class="form-label text-xs fw-bold text-slate-700">Email Address</label>
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                <input type="email" name="email" class="form-control border-start-0 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Enter your email" required autofocus autocomplete="off">
              </div>
              @error('email')
                <div class="text-danger text-xs mt-1">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label class="form-label text-xs fw-bold text-slate-700">Password</label>
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-key text-muted"></i></span>
                <input type="password" name="password" class="form-control border-start-0 @error('password') is-invalid @enderror" placeholder="••••••••••••" value="" required autocomplete="new-password">
              </div>
              @error('password')
                <div class="text-danger text-xs mt-1">{{ $message }}</div>
              @enderror
            </div>

            <div class="d-flex align-items-center justify-content-between mb-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                <label class="form-check-label text-xs text-muted" for="rememberMe">
                  Maintain persistent session
                </label>
              </div>
            </div>

            <button type="submit" class="hm-btn hm-btn-primary w-100 py-2 fw-bold">
              <i class="bi bi-box-arrow-in-right"></i> Authenticate Session
            </button>
          </form>

          <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="text-muted text-xs text-decoration-none">
              <i class="bi bi-arrow-left"></i> Return to Corporate Website
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
