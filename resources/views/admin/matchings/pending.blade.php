@extends('layouts.app')
@section('title','Pending Matches')

@push('styles')
<style>
  .bg-gradient-primary{background:linear-gradient(45deg,#0d6efd,#6610f2)!important}
  .btn-light-primary{color:#0d6efd;background:#f0f5ff;border:1px solid #0d6efd}
  .btn-light-primary:hover{background:#e2ecff}
  /* zebra like wowdash */
  #matchesTable.table-striped>tbody>tr:nth-of-type(odd){background:rgba(102,16,242,.04)}
  .badge-soft{background:#f4f6ff;border:1px solid #cdd8ff;color:#4255ff}
  .datatable-toolbar .form-control{min-width:220px}
  .action-btn{width:32px;height:32px;border-radius:50%;display:inline-flex;align-items:center;justify-content:center}
  .buyer-chip{display:inline-flex;align-items:center;gap:.5rem}
  .buyer-chip img{width:32px;height:32px;border-radius:.5rem;object-fit:cover}
</style>
@endpush

@section('content')
<div class="container my-5">
  <div class="card shadow border-0 rounded-3 basic-data-table">
    <div class="card-header bg-gradient-primary text-white d-flex align-items-center justify-content-between">
      <h4 class="mb-0 d-flex align-items-center">
        <i class="ri-links-line me-2"></i> Pending Matches
      </h4>
      <a href="{{ route('admin.buyers.index') }}" class="btn btn-light-primary">
        <i class="ri-user-3-line me-1"></i> Buyers
      </a>
    </div>

    <div class="card-body p-4">
      <!-- top toolbar (length + search) -->
      <div class="row g-3 align-items-center datatable-toolbar mb-3">
        <div class="col-auto">
          <label class="fw-medium">Show</label>
        </div>
        <div class="col-auto">
          <select id="matches-length" class="form-select form-select-sm">
            <option value="10" selected>10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="-1">All</option>
          </select>
        </div>
        <div class="col-auto ms-auto">
          <div class="input-group">
            <span class="input-group-text bg-transparent"><i class="ri-search-line"></i></span>
            <input id="matches-search" type="text" class="form-control" placeholder="Search buyers or email...">
          </div>
        </div>
      </div>

      <div class="table-responsive">
        <table id="matchesTable" class="table table-striped table-hover align-middle w-100">
          <thead class="table-light">
            <tr>
              <th style="width:70px">S.L</th>
              <th>Buyer</th>
              <th># Sellers</th>
              <th class="text-center" style="width:120px">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($buyers as $i => $b)
              <tr>
                <td>
                  <div class="form-check style-check d-flex align-items-center">
                    <input class="form-check-input" type="checkbox" value="{{ $b->id }}">
                    <label class="form-check-label">{{ str_pad($i+1,2,'0',STR_PAD_LEFT) }}</label>
                  </div>
                </td>

                <td>
                  <div class="buyer-chip">
                    <img src="{{ $b->avatar_url ?? asset('assets/images/user-list/user-list1.png') }}" alt="avatar">
                    <div class="d-flex flex-column">
                      <span class="fw-semibold">{{ $b->name }}</span>
                      <small class="text-secondary">{{ $b->email }}</small>
                    </div>
                  </div>
                </td>

                <td>
                  <span class="badge badge-soft rounded-pill px-3">
                    {{ $b->match_count }} sellers
                  </span>
                </td>

                <td class="text-center">
                  <a href="{{ route('admin.matching.show',$b) }}"
                     class="action-btn bg-primary-light text-primary-600" title="View Details">
                    <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="d-flex justify-content-between align-items-center mt-3">
        <small class="text-secondary">
          Total Buyers with Matches: <strong>{{ $buyers->count() }}</strong>
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
  $(function(){
    if(!$.fn.DataTable.isDataTable('#matchesTable')){
      const dt = $('#matchesTable').DataTable({
        responsive: true,
        pageLength: 10,
        lengthChange: false,
        order: [[2,'desc']], // show buyers with the most matches first
        columnDefs: [
          { orderable:false, targets:[0,3] }
        ],
        language:{
          search:'',
          searchPlaceholder:'Search…',
          info:'Showing _START_–_END_ of _TOTAL_'
        },
        dom: 't<"row align-items-center mt-3"<"col-sm-6"i><"col-sm-6 d-flex justify-content-end"p>>'
      });

      // external toolbar bindings
      $('#matches-search').on('keyup change', function(){ dt.search(this.value).draw(); });
      $('#matches-length').on('change', function(){
        const val = parseInt(this.value,10);
        dt.page.len(val).draw();
      });
    }
  });
</script>
@endpush
