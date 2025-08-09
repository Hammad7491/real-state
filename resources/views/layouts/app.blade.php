<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}" data-theme="light">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', config('app.name'))</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- Theme CSS (kept exactly like your HTML) --}}
  <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}" sizes="16x16"/>
  <link rel="stylesheet" href="{{ asset('assets/css/remixicon.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/css/lib/bootstrap.min.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/css/lib/apexcharts.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/css/lib/dataTables.min.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/css/lib/editor-katex.min.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/css/lib/editor.atom-one-dark.min.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/css/lib/editor.quill.snow.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/css/lib/flatpickr.min.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/css/lib/full-calendar.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/css/lib/jquery-jvectormap-2.0.5.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/css/lib/magnific-popup.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/css/lib/slick.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/css/lib/prism.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/css/lib/file-upload.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/css/lib/audioplayer.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"/>

  @stack('styles')
</head>
<body>
  {{-- Sidebar --}}
  @include('layouts.sidebar')

  <main class="dashboard-main">
    {{-- Topbar/Header --}}
    @include('layouts.topbar')

    <div class="dashboard-main-body">
      {{-- Optional breadcrumb/header area (override in child views) --}}
      @hasSection('page-header')
        @yield('page-header')
      @else
        {{-- default blank --}}
      @endif

      {{-- Main page content from child views --}}
      @yield('content')
    </div>

    {{-- Footer --}}
    @include('layouts.footer')
  </main>

  {{-- Theme JS (kept exactly like your HTML) --}}
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
  <script src="{{ asset('assets/js/homeOneChart.js') }}"></script>

  @stack('scripts')
</body>
</html>
