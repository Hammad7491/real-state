{{-- resources/views/admin/roles/form.blade.php --}}
@extends('layouts.app')

@section('title', isset($role) ? 'Edit Role' : 'New Role')

@push('styles')
<style>
  .bg-gradient-primary{background:linear-gradient(45deg,#0d6efd,#6610f2)!important}
  .card-form{border:none}
  .form-floating .form-control:focus{box-shadow:0 0 0 .2rem rgba(13,110,253,.25)}
  .perm-card{border:1px solid #e9ecef;transition:border-color .2s,box-shadow .2s}
  .perm-card:hover{border-color:#6610f2;box-shadow:0 4px 12px rgba(102,16,242,.15)}
  .perm-name{white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:100%}
  .sticky-actions{position:sticky;bottom:0;background:#fff;border-top:1px solid #eef2f7;padding:1rem;z-index:10}
  .badge-soft{background:#f3f6ff;color:#0d6efd}
</style>
@endpush

@section('content')
<div class="container my-5">
  <div class="card shadow-lg rounded-3 card-form">
    <div class="card-header bg-gradient-primary text-white d-flex align-items-center flex-wrap gap-2">
      <h4 class="mb-0 d-flex align-items-center">
        <i class="bi bi-shield-lock-fill me-2"></i>
        {{ isset($role) ? 'Edit Role' : 'New Role' }}
      </h4>

      <div class="ms-auto d-flex align-items-center gap-2">
        <a href="{{ route('admin.roles.index') }}" class="btn btn-light btn-sm">
          <i class="bi bi-arrow-left me-1"></i> Back to Roles
        </a>
      </div>
    </div>

    <div class="card-body p-4">
      @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-start" role="alert">
          <i class="bi bi-exclamation-triangle-fill me-2 fs-4 mt-1"></i>
          <ul class="mb-0">
            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
          </ul>
          <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <form method="POST" action="{{ isset($role) ? route('admin.roles.update', $role) : route('admin.roles.store') }}">
        @csrf
        @if(isset($role)) @method('PUT') @endif

        {{-- Role name --}}
        <div class="mb-4 form-floating">
          <input type="text" id="name" name="name"
                 class="form-control @error('name') is-invalid @enderror"
                 value="{{ old('name', $role->name ?? '') }}" required>
          <label for="name"><i class="bi bi-tag-fill me-1"></i> Role Name</label>
          @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Toolbar: search + bulk actions --}}
        <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
          <div class="input-group w-auto flex-grow-1" style="max-width:520px">
            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
            <input type="search" id="permSearch" class="form-control" placeholder="Search permissions (e.g. user.create)">
          </div>

          @if($guards->count() > 1)
            <div class="ms-auto">
              <select id="guardFilter" class="form-select">
                <option value="">All guards</option>
                @foreach($guards as $guard)
                  <option value="{{ $guard }}" {{ old('guard')===$guard ? 'selected':'' }}>{{ $guard }}</option>
                @endforeach
              </select>
            </div>
          @endif

          <div class="ms-auto d-flex align-items-center gap-2">
            <button type="button" id="selectAll" class="btn btn-outline-primary btn-sm">
              <i class="bi bi-check2-square me-1"></i> Select all (filtered)
            </button>
            <button type="button" id="clearAll" class="btn btn-outline-secondary btn-sm">
              <i class="bi bi-x-square me-1"></i> Clear all (filtered)
            </button>
            <span class="badge badge-soft rounded-pill ms-1">
              <i class="bi bi-shield-check me-1"></i>
              <span id="selectedCount">0</span> selected
            </span>
          </div>
        </div>

        {{-- Permissions grid --}}
        <div id="permGrid" class="row gy-3">
          @foreach($permissions as $perm)
            @php
              $isChecked = old('permissions')
                ? in_array($perm->name, (array)old('permissions'))
                : (!empty($rolePermissions) && in_array($perm->name, $rolePermissions));
              // Optional grouping key by prefix before first dot: user.create => user
              $group = str_contains($perm->name, '.') ? Str::of($perm->name)->before('.') : $perm->name;
            @endphp
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 perm-item"
                 data-name="{{ strtolower($perm->name) }}"
                 data-guard="{{ $perm->guard_name }}"
                 data-group="{{ strtolower($group) }}">
              <div class="card perm-card h-100 shadow-sm">
                <div class="card-body d-flex align-items-start gap-2">
                  <input class="form-check-input mt-1 perm-checkbox"
                         type="checkbox"
                         id="perm-{{ $perm->id }}"
                         name="permissions[]"
                         value="{{ $perm->name }}"
                         {{ $isChecked ? 'checked' : '' }}>
                  <label class="form-check-label perm-name" for="perm-{{ $perm->id }}">
                    {{ $perm->name }}
                    <div class="small text-muted">{{ $perm->guard_name }}</div>
                  </label>
                </div>
              </div>
            </div>
          @endforeach
        </div>

        {{-- Actions --}}
        <div class="sticky-actions mt-4 d-flex justify-content-end gap-2">
          <button type="submit" class="btn btn-success d-flex align-items-center">
            <i class="bi bi-save-fill me-2"></i>
            {{ isset($role) ? 'Update Role' : 'Create Role' }}
          </button>
          <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary d-flex align-items-center">
            <i class="bi bi-x-circle-fill me-2"></i> Cancel
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  (function() {
    const q = document.getElementById('permSearch');
    const guardSel = document.getElementById('guardFilter');
    const grid = document.getElementById('permGrid');
    const selectAllBtn = document.getElementById('selectAll');
    const clearAllBtn = document.getElementById('clearAll');
    const countEl = document.getElementById('selectedCount');

    function normalize(s){ return (s||'').toLowerCase().trim(); }

    function applyFilters() {
      const term = normalize(q?.value);
      const guard = guardSel ? normalize(guardSel.value) : '';

      const items = grid.querySelectorAll('.perm-item');
      let visible = 0;
      items.forEach(it => {
        const name = it.dataset.name;
        const g = normalize(it.dataset.guard);
        const show = (!term || name.includes(term)) && (!guard || g === guard);
        it.style.display = show ? '' : 'none';
        if (show) visible++;
      });
      return visible;
    }

    function updateCount(){
      const checked = grid.querySelectorAll('.perm-checkbox:checked').length;
      countEl.textContent = checked;
    }

    q && q.addEventListener('input', applyFilters);
    guardSel && guardSel.addEventListener('change', applyFilters);

    selectAllBtn && selectAllBtn.addEventListener('click', () => {
      grid.querySelectorAll('.perm-item').forEach(it => {
        if (it.style.display !== 'none') {
          const cb = it.querySelector('.perm-checkbox');
          cb.checked = true;
        }
      });
      updateCount();
    });

    clearAllBtn && clearAllBtn.addEventListener('click', () => {
      grid.querySelectorAll('.perm-item').forEach(it => {
        if (it.style.display !== 'none') {
          const cb = it.querySelector('.perm-checkbox');
          cb.checked = false;
        }
      });
      updateCount();
    });

    grid.addEventListener('change', e => {
      if (e.target.classList.contains('perm-checkbox')) updateCount();
    });

    // init
    applyFilters();
    updateCount();
  })();
</script>
@endpush
