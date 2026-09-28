@if(session('success'))
  <div class="container mt-3">
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
      <i class="bi bi-check-circle-fill fs-5 me-3"></i>
      <div class="flex-grow-1">
        <strong>Success:</strong> {{ session('success') }}
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  </div>
@endif

@if(session('error'))
  <div class="container mt-3">
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
      <i class="bi bi-exclamation-triangle-fill fs-5 me-3"></i>
      <div class="flex-grow-1">
        <strong>Error:</strong> {{ session('error') }}
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  </div>
@endif

@if(session('status'))
  <div class="container mt-3">
    <div class="alert alert-info alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
      <i class="bi bi-info-circle-fill fs-5 me-3"></i>
      <div class="flex-grow-1">
        {{ session('status') }}
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  </div>
@endif

@if(isset($errors) && $errors->any() && !request()->routeIs('contact.*') && !request()->routeIs('enquiry.*'))
  <div class="container mt-3">
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
      <div class="d-flex align-items-center mb-2">
        <i class="bi bi-x-circle-fill fs-5 me-2"></i>
        <strong>Please check the following form errors:</strong>
      </div>
      <ul class="mb-0 ps-3">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  </div>
@endif
