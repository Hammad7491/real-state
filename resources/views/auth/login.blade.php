{{-- resources/views/auth/login.blade.php --}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sign In</title>

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}" />

    <!-- Remix Icon / Iconify / Bootstrap & Wowdash libs -->
    <link rel="stylesheet" href="{{ asset('assets/css/remixicon.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lib/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lib/apexcharts.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lib/dataTables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lib/editor-katex.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lib/editor.atom-one-dark.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lib/editor.quill.snow.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lib/flatpickr.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lib/full-calendar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lib/jquery-jvectormap-2.0.5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lib/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lib/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lib/prism.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lib/file-upload.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lib/audioplayer.css') }}" />
    <!-- Wowdash main stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    <style>
      /* Small tweaks for Laravel validation + focus rings */
      .is-invalid{border-color:#dc3545!important}
      .invalid-feedback{display:block}
      .auth-right{min-height:100vh}
      .auth-left{background:linear-gradient(180deg,#f6f7ff, #eef2ff)}
    </style>
  </head>
  <body>

    <section class="auth bg-base d-flex flex-wrap">
      <!-- Left visual -->
      <div class="auth-left d-lg-block d-none">
        <div class="d-flex align-items-center flex-column h-100 justify-content-center">
          <img src="{{ asset('assets/images/auth/auth-img.png') }}" alt="Auth illustration">
        </div>
      </div>

      <!-- Right form -->
      <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
        <div class="max-w-464-px mx-auto w-100">
          <div class="mb-4">
            <a href="{{ url('/') }}" class="mb-40 max-w-290-px d-inline-block">
              <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
            </a>
            <h4 class="mb-12">Sign in to your account</h4>
            <p class="mb-0 text-secondary-light text-lg">Welcome back! Please enter your details.</p>
          </div>

          <!-- Laravel errors -->
          @if($errors->any())
            <div class="alert alert-danger mt-3">
              <ul class="mb-0">
                @foreach($errors->all() as $e)
                  <li>{{ $e }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="POST" action="{{ route('login') }}" id="loginForm" class="mt-32">
            @csrf

            <div class="icon-field mb-16">
              <span class="icon top-50 translate-middle-y">
                <iconify-icon icon="mage:email"></iconify-icon>
              </span>
              <input
                type="email"
                name="email"
                class="form-control h-56-px bg-neutral-50 radius-12 @error('email') is-invalid @enderror"
                placeholder="Email"
                value="{{ old('email') }}"
                required
                autocomplete="email"
              >
              @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="position-relative mb-20">
              <div class="icon-field">
                <span class="icon top-50 translate-middle-y">
                  <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                </span>
                <input
                  type="password"
                  name="password"
                  id="your-password"
                  class="form-control h-56-px bg-neutral-50 radius-12 @error('password') is-invalid @enderror"
                  placeholder="Password"
                  required
                  autocomplete="current-password"
                >
              </div>
              <span
                class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light"
                data-toggle="#your-password"
                aria-label="Toggle password visibility"
                role="button"
              ></span>
              @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex justify-content-between gap-2 mb-8">
              <div class="form-check style-check d-flex align-items-center">
                <input
                  class="form-check-input border border-neutral-300"
                  type="checkbox"
                  id="remember"
                  name="remember"
                  {{ old('remember') ? 'checked' : '' }}
                >
                <label class="form-check-label" for="remember">Remember me</label>
              </div>
              <a href="#" class="text-primary-600 fw-medium">Forgot Password?</a>
            </div>

            <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-16">
              Sign In
            </button>

            <!-- Quick admin helper (kept from old) -->
            <button
              type="button"
              class="btn btn-outline-secondary w-100 radius-12 mt-12"
              onclick="fillLogin('a@a','a')"
            >
              Quick Admin Login
            </button>

            <div class="mt-32 center-border-horizontal text-center">
              <span class="bg-base z-1 px-4">Or sign in with</span>
            </div>

            <div class="mt-24 d-flex align-items-center gap-3">
              <a href="{{ route('facebook.login') }}" class="fw-semibold text-primary-light py-16 px-24 w-50 border radius-12 text-md d-flex align-items-center justify-content-center gap-12 line-height-1 bg-hover-primary-50">
                <iconify-icon icon="ic:baseline-facebook" class="text-primary-600 text-xl line-height-1"></iconify-icon>
                Facebook
              </a>
              <a href="{{ route('google.login') }}" class="fw-semibold text-primary-light py-16 px-24 w-50 border radius-12 text-md d-flex align-items-center justify-content-center gap-12 line-height-1 bg-hover-primary-50">
                <iconify-icon icon="logos:google-icon" class="text-primary-600 text-xl line-height-1"></iconify-icon>
                Google
              </a>
            </div>

            <div class="mt-32 text-center text-sm">
              <p class="mb-0">
                Don’t have an account?
                <a href="{{ route('registerform') }}" class="text-primary-600 fw-semibold">Sign Up</a>
              </p>
            </div>
          </form>
        </div>
      </div>
    </section>

    <!-- Scripts (via asset) -->
    <script src="{{ asset('assets/js/lib/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/iconify-icon.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery-jvectormap-2.0.5.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/js/lib/magnifc-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/prism.js') }}"></script>
    <script src="{{ asset('assets/js/lib/file-upload.js') }}"></script>
    <script src="{{ asset('assets/js/lib/audioplayer.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script>
      // Password Show/Hide (keeps your new UI pattern)
      function initializePasswordToggle(toggleSelector) {
        $(toggleSelector).on('click', function() {
          $(this).toggleClass('ri-eye-off-line');
          const input = $($(this).attr('data-toggle'));
          input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
        });
      }
      initializePasswordToggle('.toggle-password');

      // Quick-fill & submit (kept from old)
      function fillLogin(email, pass) {
        document.querySelector('input[name="email"]').value = email;
        document.querySelector('input[name="password"]').value = pass;
        document.getElementById('loginForm').submit();
      }
      window.fillLogin = fillLogin;
    </script>
  </body>
</html>
