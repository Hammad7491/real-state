{{-- resources/views/admin/permissions/form.blade.php --}}
@extends('layouts.app')

@section('title', isset($permission) ? 'Edit Permission' : 'New Permission')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Poppins:wght@700&display=swap" rel="stylesheet">
<style>
  body{font-family:'Inter',sans-serif}
  h4{font-family:'Poppins',sans-serif}
  .bg-gradient-primary{background:linear-gradient(45deg,#0d6efd,#6610f2)!important}
  .form-floating .form-control:focus{box-shadow:0 0 0 .2rem rgba(13,110,253,.25)}
  .btn-success{background-color:#198754;border:none}.btn-success:hover{background-color:#157347}
  .hint{font-size:.875rem;color:#6c757d}
  .preview{font-family:ui-monospace,SFMono-Regular,Menlo,monospace}
</style>
@endpush

@section('content')
<div class="container my-5">
  <div class="card shadow border-0 rounded-3">
    <div class="card-header bg-gradient-primary text-white d-flex align-items-center">
      <h4 class="mb-0">
        <i class="bx bx-key me-2"></i>
        {{ isset($permission) ? 'Edit Permission' : 'New Permission' }}
      </h4>
      <a href="{{ route('admin.permissions.index') }}" class="btn btn-light btn-sm ms-auto">
        <i class="bx bx-list-ul me-1"></i> All Permissions
      </a>
    </div>

    <div class="card-body p-4">
      @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
          <i class="bx bx-error me-2 fs-4"></i>
          <ul class="mb-0">
            @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
          </ul>
          <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <form method="POST" action="{{ isset($permission) ? route('admin.permissions.update', $permission) : route('admin.permissions.store') }}">
        @csrf
        @if(isset($permission)) @method('PUT') @endif

        <div class="row g-3">
          {{-- Optional: module/prefix --}}
          <div class="col-md-4">
            <div class="form-floating">
              <input type="text" id="module" class="form-control"
                     placeholder=" " value="{{ old('module') }}"
                     autocomplete="off">
              <label for="module"><i class="bx bx-folder me-1"></i> Module (optional)</label>
              <div class="hint mt-2">Example: <code>users</code>, <code>posts</code></div>
            </div>
          </div>

          {{-- Action / name input (required) --}}
          <div class="col-md-5">
            <div class="form-floating">
              <input type="text" id="action" name="name"
                     class="form-control @error('name') is-invalid @enderror"
                     value="{{ old('name', $permission->name ?? '') }}"
                     placeholder=" " required>
              <label for="action"><i class="bx bx-tag me-1"></i> Permission (or action)</label>
              @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
              <div class="hint mt-2">Write full permission or just action. If module is set, final value becomes <span class="preview" id="previewEx">module.action</span>.</div>
            </div>
          </div>

          {{-- Guard --}}
          <div class="col-md-3">
            <div class="form-floating">
              <select id="guard_name" name="guard_name" class="form-select @error('guard_name') is-invalid @enderror" required>
                @foreach(($guards ?? collect([config('auth.defaults.guard')])) as $guard)
                  <option value="{{ $guard }}"
                    {{ old('guard_name', $permission->guard_name ?? config('auth.defaults.guard')) === $guard ? 'selected' : '' }}>
                    {{ $guard }}
                  </option>
                @endforeach
              </select>
              <label for="guard_name"><i class="bx bx-lock-alt me-1"></i> Guard</label>
              @error('guard_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
          </div>

          {{-- Final hidden field if using module+action composition --}}
          <input type="hidden" id="finalName" name="name" value="{{ old('name', $permission->name ?? '') }}">
        </div>

        <div class="d-flex align-items-center justify-content-between mt-3">
          <div class="hint">
            Final permission:&nbsp;
            <span class="preview fw-semibold" id="finalPreview">{{ old('name', $permission->name ?? '') ?: '—' }}</span>
          </div>
          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success d-flex align-items-center">
              <i class="bx bx-save me-1"></i>
              {{ isset($permission) ? 'Update Permission' : 'Create Permission' }}
            </button>
            <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-secondary d-flex align-items-center">
              <i class="bx bx-arrow-back me-1"></i> Back to List
            </a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  (function(){
    const moduleInput = document.getElementById('module');
    const actionInput = document.getElementById('action');
    const hiddenFinal  = document.getElementById('finalName');
    const finalPrev    = document.getElementById('finalPreview');

    function compose(){
      const m = (moduleInput.value || '').trim().replace(/\.$/,'');
      const a = (actionInput.value || '').trim();
      const val = m && a ? `${m}.${a}` : (a || m);
      // If user typed full permission already (contains dot) and no module given, keep it
      const finalVal = (m ? val : a);
      hiddenFinal.value = finalVal;
      finalPrev.textContent = finalVal || '—';
    }

    moduleInput.addEventListener('input', compose);
    actionInput.addEventListener('input', compose);
    // init
    compose();
  })();
</script>
@endpush
