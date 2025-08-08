@extends('layouts.app')

@section('title', isset($permission) ? 'Edit Permission' : 'New Permission')

@push('styles')
  <!-- Google Fonts: Inter & Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Poppins:wght@700&display=swap" rel="stylesheet">

  <style>
    /* Font families */
    body { font-family: 'Inter', sans-serif; }
    h4 { font-family: 'Poppins', sans-serif; }

    /* Header gradient */
    .bg-gradient-primary { background: linear-gradient(45deg, #0d6efd, #6610f2) !important; }

    /* Form focus */
    .form-floating .form-control:focus {
      box-shadow: 0 0 0 0.2rem rgba(13,110,253,0.25);
    }

    /* Save button */
    .btn-success {
      background-color: #198754;
      border: none;
    }
    .btn-success:hover {
      background-color: #157347;
    }
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
    </div>
    <div class="card-body p-4">
      @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
          <i class="bx bx-error me-2 fs-4"></i>
          <ul class="mb-0">
            @foreach($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
          <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <form
        action="{{ isset($permission)
                   ? route('admin.permissions.update', $permission)
                   : route('admin.permissions.store') }}"
        method="POST"
      >
        @csrf
        @if(isset($permission)) @method('PUT') @endif

        <div class="form-floating mb-4">
          <input
            type="text"
            id="name"
            name="name"
            class="form-control"
            value="{{ old('name', $permission->name ?? '') }}"
            required
          >
          <label for="name">
            <i class="bx bx-tag me-1"></i>
            Permission Name
          </label>
        </div>

        <div class="d-flex justify-content-end">
          <button type="submit" class="btn btn-success me-2 d-flex align-items-center">
            <i class="bx bx-save me-1"></i>
            {{ isset($permission) ? 'Update Permission' : 'Create Permission' }}
          </button>
          <a
            href="{{ route('admin.permissions.index') }}"
            class="btn btn-outline-secondary d-flex align-items-center"
          >
            <i class="bx bx-arrow-back me-1"></i>
            Back to List
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
