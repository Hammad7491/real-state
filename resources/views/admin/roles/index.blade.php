@extends('layouts.app')

@section('title', 'Roles')

@push('styles')
  <!-- Google Fonts: Inter & Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Poppins:wght@700&display=swap" rel="stylesheet">

  <!-- DataTables Bootstrap 5 CSS -->
  <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

  <style>
    /* Font families */
    body {
      font-family: 'Inter', sans-serif;
    }
    h4, th {
      font-family: 'Poppins', sans-serif;
    }

    /* Header gradient */
    .bg-gradient-primary {
      background: linear-gradient(45deg, #0d6efd, #6610f2) !important;
    }

    /* “Light primary” button */
    .btn-light-primary {
      color: #0d6efd;
      background-color: #f0f5ff;
      border: 1px solid #0d6efd;
    }
    .btn-light-primary:hover {
      background-color: #e2ecff;
    }

    /* Striped rows */
    #roles-table.table-striped > tbody > tr:nth-of-type(odd) {
      background-color: rgba(102,16,242,0.05);
    }

    /* Stronger table header line */
    #roles-table thead th {
      border-bottom-width: 2px;
    }

    /* Permission badge */
    .badge-permission {
      background: #6610f2;
      font-weight: 600;
      text-transform: capitalize;
    }
  </style>
@endpush

@section('content')
<div class="container my-5">
  <div class="card shadow border-0 rounded-3">
    <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0">
        <i class="bx bx-shield-lock me-2"></i>
        Roles List
      </h4>
      <a href="{{ route('admin.roles.create') }}" class="btn btn-light-primary btn-sm d-flex align-items-center">
        <i class="bx bx-plus-medical me-1"></i>
        New Role
      </a>
    </div>

    <div class="card-body p-4">
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
          <i class="bx bx-check-circle me-2 fs-4"></i>
          <div>{{ session('success') }}</div>
          <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <div class="table-responsive">
        <table id="roles-table" class="table table-striped table-hover align-middle mb-0 w-100">
          <thead class="table-light">
            <tr>
              <th><i class="bx bx-tag me-1"></i>Name</th>
              <th><i class="bx bx-lock me-1"></i>Permissions</th>
              <th class="text-center"><i class="bx bx-slider-alt me-1"></i>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($roles as $role)
              <tr>
                <td class="fw-semibold">{{ $role->name }}</td>
                <td>
                  @foreach($role->permissions as $permission)
                    <a href="{{ route('admin.permissions.show', $permission) }}"
                       class="badge badge-permission text-white me-1 rounded-pill"
                       title="View/Edit {{ ucfirst($permission->name) }}">
                      <i class="bx bx-key me-1"></i>
                      {{ ucfirst($permission->name) }}
                    </a>
                  @endforeach
                </td>
                <td class="text-center">
                  <a href="{{ route('admin.roles.show', $role) }}" class="btn btn-sm btn-outline-secondary me-1" title="View">
                    <i class="bx bx-show"></i>
                  </a>
                  <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-sm btn-outline-primary me-1" title="Edit">
                    <i class="bx bx-edit"></i>
                  </a>
                  <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button
                      type="submit"
                      class="btn btn-sm btn-outline-danger"
                      onclick="return confirm('Delete this role?')"
                      title="Delete">
                      <i class="bx bx-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
  <!-- jQuery and DataTables -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
  <script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#roles-table').DataTable({
        responsive: true,
        language: {
          searchPlaceholder: 'Search roles…',
          search: ''
        },
        columnDefs: [
          { orderable: false, targets: 2 } // disable sorting on Actions
        ]
      });
    });
  </script>
@endpush
