@extends('layouts.app')

@section('title', 'Buyers')

@push('styles')
  <style>
    .bg-gradient-primary{background:linear-gradient(45deg,#0d6efd,#6610f2)!important}
    .btn-light-primary{color:#0d6efd;background:#f0f5ff;border:1px solid #0d6efd}
    .btn-light-primary:hover{background:#e2ecff}
    .table thead th{border-bottom-width:2px}
    /* subtle zebra like wowdash */
    #buyersTable.table-striped>tbody>tr:nth-of-type(odd){background:rgba(102,16,242,.04)}
    /* name cell */
    .buyer-avatar{width:36px;height:36px;border-radius:.5rem;object-fit:cover}
    .badge-soft{background:#f4f6ff;border:1px solid #cdd8ff;color:#4255ff}
    .datatable-toolbar .form-control{min-width:220px}
    .action-btn{width:32px;height:32px;border-radius:50%;display:inline-flex;align-items:center;justify-content:center}
  </style>
@endpush

@section('content')
<div class="container my-5">
  <div class="card shadow border-0 rounded-3 basic-data-table">
    <div class="card-header bg-gradient-primary text-white">
      <div class="d-flex align-items-center justify-content-between">
        <h4 class="mb-0 d-flex align-items-center">
          <i class="ri-user-3-line me-2"></i> Buyers
        </h4>
        <a href="{{ route('admin.buyers.create') }}" class="btn btn-light-primary">
          <i class="ri-user-add-line me-1"></i> Add New Buyer
        </a>
      </div>
    </div>

    <div class="card-body p-4">
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
          <i class="ri-checkbox-circle-line me-2 fs-5"></i>
          <div>{{ session('success') }}</div>
          <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <!-- top toolbar (search + length) -->
      <div class="row g-3 align-items-center datatable-toolbar mb-3">
        <div class="col-auto">
          <label class="fw-medium">Show</label>
        </div>
        <div class="col-auto">
          <select id="buyers-length" class="form-select form-select-sm">
            <option value="10" selected>10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="-1">All</option>
          </select>
        </div>
        <div class="col-auto ms-auto">
          <div class="input-group">
            <span class="input-group-text bg-transparent"><i class="ri-search-line"></i></span>
            <input id="buyers-search" type="text" class="form-control" placeholder="Search buyers...">
          </div>
        </div>
      </div>

      <div class="table-responsive">
        <table id="buyersTable" class="table table-striped table-hover align-middle w-100">
          <thead class="table-light">
            <tr>
              <th style="width:70px">S.L</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Criteria</th>
              <th class="text-center" style="width:120px">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($buyers as $i => $buyer)
              <tr>
                <td>
                  <div class="form-check style-check d-flex align-items-center">
                    <input class="form-check-input" type="checkbox" value="{{ $buyer->id }}">
                    <label class="form-check-label">{{ str_pad($i+1,2,'0',STR_PAD_LEFT) }}</label>
                  </div>
                </td>

                <td class="text-nowrap">
                  <div class="d-flex align-items-center">
                    <img
                      src="{{ $buyer->avatar_url ?? asset('assets/images/user-list/user-list1.png') }}"
                      class="buyer-avatar me-2" alt="avatar">
                    <div class="d-flex flex-column">
                      <span class="fw-semibold">{{ $buyer->name }}</span>
                      @if($buyer->notes)
                        <small class="text-secondary">{{ Str::limit($buyer->notes, 36) }}</small>
                      @endif
                    </div>
                  </div>
                </td>

                <td>
                  <a href="mailto:{{ $buyer->email }}" class="text-primary-600">
                    <i class="ri-mail-line me-1"></i>{{ $buyer->email }}
                  </a>
                </td>

                <td>
                  <i class="ri-phone-line me-1"></i>{{ $buyer->phone ?? '—' }}
                </td>

                <td>
                  <span class="badge badge-soft rounded-pill px-3">
                    {{ $buyer->criteria->count() }} rules
                  </span>
                </td>

                <td class="text-center">
                  <a href="{{ route('admin.buyers.edit', $buyer) }}"
                     class="action-btn bg-success-focus text-success-main me-1" title="Edit">
                    <iconify-icon icon="lucide:edit"></iconify-icon>
                  </a>
                  <a href="{{ route('admin.buyers.show', $buyer) }}"
                     class="action-btn bg-primary-light text-primary-600 me-1" title="View">
                    <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                  </a>
                  <form action="{{ route('admin.buyers.destroy', $buyer) }}"
                        method="POST" class="d-inline"
                        onsubmit="return confirm('Delete this buyer?')">
                    @csrf @method('DELETE')
                    <button class="action-btn bg-danger-focus text-danger-main border-0" title="Delete">
                      <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- footer info area -->
      <div class="d-flex justify-content-between align-items-center mt-3">
        <small class="text-secondary">
          Total Buyers: <strong>{{ $buyers->count() }}</strong>
        </small>
        <small class="text-secondary">
          Updated: <strong>{{ now()->format('d M Y, h:i A') }}</strong>
        </small>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(function () {
    // init only once
    if (!$.fn.DataTable.isDataTable('#buyersTable')) {
      const dt = $('#buyersTable').DataTable({
        responsive: true,
        pageLength: 10,
        lengthChange: false,
        order: [[1, 'asc']], // sort by Name
        columnDefs: [
          { orderable: false, targets: [0, 5] } // checkbox + actions
        ],
        language: {
          search: '',
          searchPlaceholder: 'Search…',
          info: 'Showing _START_–_END_ of _TOTAL_'
        },
        dom: 't<"row align-items-center mt-3"<"col-sm-6"i><"col-sm-6 d-flex justify-content-end"p>>'
      });

      // external toolbar bindings
      $('#buyers-search').on('keyup change', function(){ dt.search(this.value).draw(); });
      $('#buyers-length').on('change', function(){
        const val = parseInt(this.value, 10);
        dt.page.len(val).draw();
      });
    }
  });
</script>
@endpush
