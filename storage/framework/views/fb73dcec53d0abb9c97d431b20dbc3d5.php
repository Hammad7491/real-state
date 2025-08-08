<?php $__env->startSection('title', 'Permissions'); ?>

<?php $__env->startPush('styles'); ?>
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
    #permissions-table.table-striped > tbody > tr:nth-of-type(odd) {
      background-color: rgba(102,16,242,0.05);
    }

    /* Stronger table header line */
    #permissions-table thead th {
      border-bottom-width: 2px;
    }
  </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
  <div class="card shadow border-0 rounded-3">
    <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0">
        <i class="bx bx-key me-2"></i>
        Permissions List
      </h4>
      <a href="<?php echo e(route('admin.permissions.create')); ?>" class="btn btn-light-primary btn-sm d-flex align-items-center">
        <i class="bx bx-plus-medical me-1"></i>
        New Permission
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
        <table id="permissions-table" class="table table-striped table-hover align-middle mb-0 w-100">
          <thead class="table-light">
            <tr>
              <th><i class="bx bx-tag me-1"></i>Name</th>
              <th class="text-center"><i class="bx bx-slider-alt me-1"></i>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td class="fw-semibold"><?php echo e($permission->name); ?></td>
                <td class="text-center">
                  <a href="<?php echo e(route('admin.permissions.show', $permission)); ?>" class="btn btn-sm btn-outline-secondary me-1" title="View">
                    <i class="bx bx-show"></i>
                  </a>
                  <a href="<?php echo e(route('admin.permissions.edit', $permission)); ?>" class="btn btn-sm btn-outline-primary me-1" title="Edit">
                    <i class="bx bx-edit"></i>
                  </a>
                  <form action="<?php echo e(route('admin.permissions.destroy', $permission)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this permission?')" title="Delete">
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <!-- jQuery and DataTables -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
  <script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#permissions-table').DataTable({
        responsive: true,
        language: {
          searchPlaceholder: 'Search permissions…',
          search: ''
        },
        columnDefs: [
          { orderable: false, targets: 1 } // disable sorting on Actions
        ]
      });
    });
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/htdocs/kunaki/resources/views/admin/permissions/index.blade.php ENDPATH**/ ?>