<?php $__env->startSection('title', 'Buyers'); ?>

<?php $__env->startPush('styles'); ?>
  <!-- DataTables Bootstrap 5 CSS is already in your main layout -->
  <style>
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
    #buyers-table.table-striped > tbody > tr:nth-of-type(odd) {
      background-color: rgba(102,16,242,0.05);
    }
    /* Stronger table header line */
    #buyers-table thead th {
      border-bottom-width: 2px;
    }
  </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
  <div class="card shadow border-0 rounded-3">
    <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0"><i class="bx bx-user-pin me-2"></i>Buyers List</h4>
      <a href="<?php echo e(route('admin.buyers.create')); ?>" class="btn btn-light-primary btn-sm">
        <i class="bx bx-user-plus me-1"></i> Add New Buyer
      </a>
    </div>

    <div class="card-body p-4">
      <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
          <i class="bx bx-check-circle me-2 fs-4"></i>
          <div><?php echo e(session('success')); ?></div>
          <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>

      <div class="table-responsive">
        <table id="buyers-table"
               class="table table-striped table-hover align-middle mb-0 w-100">
          <thead class="table-light">
            <tr>
              <th><i class="bx bx-user me-1"></i>Name</th>
              <th><i class="bx bx-envelope me-1"></i>Email</th>
              <th><i class="bx bx-phone me-1"></i>Phone</th>
              <th><i class="bx bx-list-check me-1"></i>Criteria</th>
              <th class="text-center"><i class="bx bx-cog me-1"></i>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $buyers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td class="fw-semibold">
                  <i class="bx bx-user me-1"></i>
                  <?php echo e($buyer->name); ?>

                </td>
                <td>
                  <i class="bx bx-envelope me-1"></i>
                  <a href="mailto:<?php echo e($buyer->email); ?>"><?php echo e($buyer->email); ?></a>
                </td>
                <td>
                  <i class="bx bx-phone me-1"></i>
                  <?php echo e($buyer->phone ?? '—'); ?>

                </td>
                <td>
                  <span class="badge bg-secondary"><?php echo e($buyer->criteria->count()); ?></span>
                </td>
                <td class="text-center">
                  <a href="<?php echo e(route('admin.buyers.edit', $buyer)); ?>"
                     class="btn btn-sm btn-outline-primary me-1"
                     title="Edit">
                    <i class="bx bx-edit"></i>
                  </a>
                  <form action="<?php echo e(route('admin.buyers.destroy', $buyer)); ?>"
                        method="POST"
                        class="d-inline"
                        onsubmit="return confirm('Delete this buyer?')">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-sm btn-outline-danger" title="Delete">
                      <i class="bx bx-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
<script>
  $(function() {
    if ( ! $.fn.DataTable.isDataTable('#buyers-table') ) {
      $('#buyers-table').DataTable({
        responsive: true,
        language: {
          searchPlaceholder: 'Search buyers…',
          search: ''
        },
        columnDefs: [
          { orderable: false, targets: 4 }
        ]
      });
    }
  });
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/htdocs/real-estate/resources/views/admin/buyers/index.blade.php ENDPATH**/ ?>