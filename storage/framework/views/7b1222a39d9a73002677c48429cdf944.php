<?php $__env->startSection('title', 'Users'); ?>

<?php $__env->startPush('styles'); ?>
  <!-- DataTables Bootstrap 5 CSS -->

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
    #users-table.table-striped > tbody > tr:nth-of-type(odd) {
      background-color: rgba(102,16,242,0.05);
    }

    /* Stronger table header line */
    #users-table thead th {
      border-bottom-width: 2px;
    }

    /* Custom badge color */
    .badge-role {
      background: #6610f2;
    }
  </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
  <div class="card shadow border-0 rounded-3">
    <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0">
        <i class="bx bx-user-pin me-2"></i>
        Users List
      </h4>
      <a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-light-primary btn-sm d-flex align-items-center">
        <i class="bx bx-user-plus me-1"></i>
        Add New User
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
        <table id="users-table" class="table table-striped table-hover align-middle mb-0 w-100">
          <thead class="table-light">
            <tr>
              <th><i class="bx bx-user me-1"></i>Name</th>
              <th><i class="bx bx-envelope me-1"></i>Email</th>
              <th><i class="bx bx-shield-quarter me-1"></i>Roles</th>
              <th class="text-center"><i class="bx bx-cog me-1"></i>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td class="fw-semibold">
                  <i class="bx bx-user me-1"></i>
                  <a href="<?php echo e(route('admin.users.show', $user)); ?>" class="text-decoration-none text-dark">
                    <?php echo e($user->name); ?>

                  </a>
                </td>
                <td>
                  <i class="bx bx-envelope me-1"></i>
                  <a href="mailto:<?php echo e($user->email); ?>" class="text-decoration-none">
                    <?php echo e($user->email); ?>

                  </a>
                </td>
                <td>
                  <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="badge badge-role text-white me-1 rounded-pill">
                      <?php echo e(ucfirst($role->name)); ?>

                    </span>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
                <td class="text-center">
                  <a href="<?php echo e(route('admin.users.show', $user)); ?>" class="btn btn-sm btn-outline-secondary me-1" title="View">
                    <i class="bx bx-show"></i>
                  </a>
                  <a href="<?php echo e(route('admin.users.edit', $user)); ?>" class="btn btn-sm btn-outline-primary me-1" title="Edit">
                    <i class="bx bx-edit"></i>
                  </a>
                  <form action="<?php echo e(route('admin.users.destroy', $user)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button
                      type="submit"
                      class="btn btn-sm btn-outline-danger"
                      onclick="return confirm('Are you sure you want to delete this user?')"
                      title="Delete"
                    >
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
  <!-- jQuery first, then DataTables -->

  <script>
    $(document).ready(function() {
      $('#users-table').DataTable({
        responsive: true,
        language: {
          searchPlaceholder: 'Search users…',
          search: ''
        },
        columnDefs: [
          { orderable: false, targets: 3 } // disable sorting on Actions column
        ]
      });
    });
  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/htdocs/real-estate/resources/views/admin/users/index.blade.php ENDPATH**/ ?>