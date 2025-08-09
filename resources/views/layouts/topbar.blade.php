<div class="navbar-header">
  <div class="row align-items-center justify-content-between">
    <div class="col-auto">
      <div class="d-flex flex-wrap align-items-center gap-4">
        <button type="button" class="sidebar-toggle">
          <iconify-icon icon="heroicons:bars-3-solid" class="icon text-2xl non-active"></iconify-icon>
          <iconify-icon icon="iconoir:arrow-right" class="icon text-2xl active"></iconify-icon>
        </button>
        <button type="button" class="sidebar-mobile-toggle">
          <iconify-icon icon="heroicons:bars-3-solid" class="icon"></iconify-icon>
        </button>

        {{-- Optional: wire this to a real search route later --}}
        <form class="navbar-search" method="GET" action="#">
          <input type="text" name="q" placeholder="Search" value="{{ request('q') }}">
          <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
        </form>
      </div>
    </div>

    <div class="col-auto">
      <div class="d-flex flex-wrap align-items-center gap-3">

        {{-- Theme toggle keeps data-theme-toggle attribute as in your HTML --}}
        <button type="button" data-theme-toggle
                class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"></button>

        {{-- Language / Messages / Notifications dropdowns kept as static demo (replace if you have data) --}}
        @includeWhen(View::exists('partials.topbar-language'), 'partials.topbar-language')
        @includeWhen(View::exists('partials.topbar-messages'), 'partials.topbar-messages')
        @includeWhen(View::exists('partials.topbar-notifications'), 'partials.topbar-notifications')

        {{-- Profile --}}
        @auth
        <div class="dropdown">
          <button class="d-flex justify-content-center align-items-center rounded-circle" type="button" data-bs-toggle="dropdown">
            <img src="{{ asset('assets/images/user.png') }}" alt="image" class="w-40-px h-40-px object-fit-cover rounded-circle">
          </button>
          <div class="dropdown-menu to-top dropdown-menu-sm">
            <div class="py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
              <div>
                <h6 class="text-lg text-primary-light fw-semibold mb-2">{{ Auth::user()->name }}</h6>
                <span class="text-secondary-light fw-medium text-sm">Admin</span>
              </div>
              <button type="button" class="hover-text-danger">
                <iconify-icon icon="radix-icons:cross-1" class="icon text-xl"></iconify-icon>
              </button>
            </div>
            <ul class="to-top-list">
              <li>
                <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"
                   href="#">
                  <iconify-icon icon="solar:user-linear" class="icon text-xl"></iconify-icon> My Profile
                </a>
              </li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-danger d-flex align-items-center gap-3">
                    <iconify-icon icon="lucide:power" class="icon text-xl"></iconify-icon> Log Out
                  </button>
                </form>
              </li>
            </ul>
          </div>
        </div>
        @else
        <a href="{{ route('login') }}" class="btn btn-sm btn-primary">Login</a>
        @endauth

      </div>
    </div>
  </div>
</div>
