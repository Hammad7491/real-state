<aside class="sidebar">
  <button type="button" class="sidebar-close-btn">
    <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
  </button>

  <div class="sidebar-header px-16 py-12 d-flex align-items-center gap-2">
    <a href="{{ url('/') }}" class="sidebar-logo d-flex align-items-center gap-2">
      <img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
      <h4 class="logo-text mb-0">Dashtrans</h4>
    </a>
    <button class="ms-auto toggle-icon border-0 bg-transparent p-0">
      <iconify-icon icon="bx:arrow-back"></iconify-icon>
    </button>
  </div>

  @php
    $usersMenuOpen = request()->routeIs('admin.users.*') || request()->routeIs('admin.roles.*') || request()->routeIs('admin.permissions.*');
    $buyersMenuOpen = request()->routeIs('admin.buyers.*');
    $matchingMenuOpen = request()->routeIs('admin.matching.*');
  @endphp

  <div class="sidebar-menu-area">
    <ul class="sidebar-menu" id="sidebar-menu">
      {{-- Dashboard --}}
      <li>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
          <span class="menu-icon d-flex"><iconify-icon icon="bx:bar-chart-alt-2"></iconify-icon></span>
          <span>Dashboard</span>
        </a>
      </li>

      {{-- Users (label) --}}
      <li class="sidebar-menu-group-title">Users</li>

      {{-- User Management --}}
      <li class="dropdown {{ $usersMenuOpen ? 'open' : '' }}">
        <a href="javascript:void(0)">
          <span class="menu-icon d-flex"><iconify-icon icon="bx:user"></iconify-icon></span>
          <span>User Management</span>
        </a>
        <ul class="sidebar-submenu" style="{{ $usersMenuOpen ? 'display:block' : '' }}">
          <li>
            <a href="{{ route('admin.users.create') }}" class="{{ request()->routeIs('admin.users.create') ? 'active' : '' }}">
              <iconify-icon icon="bx:user-plus" class="w-auto me-2"></iconify-icon> Add User
            </a>
          </li>
          <li>
            <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
              <iconify-icon icon="bx:user" class="w-auto me-2"></iconify-icon> Users List
            </a>
          </li>
          <li>
            <a href="{{ route('admin.roles.index') }}" class="{{ request()->routeIs('admin.roles.index') ? 'active' : '' }}">
              <iconify-icon icon="bx:shield-quarter" class="w-auto me-2"></iconify-icon> Roles &amp; Permissions
            </a>
          </li>
          <li>
            <a href="{{ route('admin.permissions.index') }}" class="{{ request()->routeIs('admin.permissions.index') ? 'active' : '' }}">
              <iconify-icon icon="bx:lock-open-alt" class="w-auto me-2"></iconify-icon> Permissions
            </a>
          </li>
        </ul>
      </li>

      {{-- Users (label) - as in old menu (kept) --}}
      <li class="sidebar-menu-group-title">Users</li>

      {{-- Buyer Management --}}
      <li class="dropdown {{ $buyersMenuOpen ? 'open' : '' }}">
        <a href="javascript:void(0)">
          <span class="menu-icon d-flex"><iconify-icon icon="bx:user"></iconify-icon></span>
          <span>Buyer Management</span>
        </a>
        <ul class="sidebar-submenu" style="{{ $buyersMenuOpen ? 'display:block' : '' }}">
          <li>
            <a href="{{ route('admin.buyers.create') }}" class="{{ request()->routeIs('admin.buyers.create') ? 'active' : '' }}">
              <iconify-icon icon="bx:lock-open-alt" class="w-auto me-2"></iconify-icon> Create Buyer
            </a>
          </li>
          <li>
            <a href="{{ route('admin.buyers.index') }}" class="{{ request()->routeIs('admin.buyers.index') ? 'active' : '' }}">
              <iconify-icon icon="bx:lock-open-alt" class="w-auto me-2"></iconify-icon> Buyer List
            </a>
          </li>
        </ul>
      </li>

      {{-- Matching (label) --}}
      <li class="sidebar-menu-group-title">Matching</li>

      {{-- Matching Management --}}
      <li class="dropdown {{ $matchingMenuOpen ? 'open' : '' }}">
        <a href="javascript:void(0)">
          <span class="menu-icon d-flex"><iconify-icon icon="bx:user"></iconify-icon></span>
          <span>Matching Management</span>
        </a>
        <ul class="sidebar-submenu" style="{{ $matchingMenuOpen ? 'display:block' : '' }}">
          <li>
            <a href="{{ route('admin.matching.pending') }}" class="{{ request()->routeIs('admin.matching.pending') ? 'active' : '' }}">
              <iconify-icon icon="bx:lock-open-alt" class="w-auto me-2"></iconify-icon> Pending Matching
            </a>
          </li>
          {{-- <li>
            <a href="{{ route('admin.buyers.index') }}" class="{{ request()->fullUrlIs('*accepted*') ? 'active' : '' }}">
              <iconify-icon icon="bx:lock-open-alt" class="w-auto me-2"></iconify-icon> Accepted Matching
            </a>
          </li>
          <li>
            <a href="{{ route('admin.buyers.index') }}" class="{{ request()->fullUrlIs('*rejected*') ? 'active' : '' }}">
              <iconify-icon icon="bx:lock-open-alt" class="w-auto me-2"></iconify-icon> Rejected Matching
            </a>
          </li> --}}
        </ul>
      </li>
    </ul>
  </div>
</aside>
