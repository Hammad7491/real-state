<?php $__env->startSection('title', isset($role) ? 'Edit Role' : 'New Role'); ?>

<?php $__env->startPush('styles'); ?>
  <style>
    /* Header gradient */
    .bg-gradient-primary {
      background: linear-gradient(45deg, #0d6efd, #6610f2) !important;
    }

    /* Form card */
    .card-form {
      border: none;
    }

    /* Floating labels focus */
    .form-floating .form-control:focus {
      box-shadow: 0 0 0 0.2rem rgba(13,110,253,0.25);
    }

    /* Permission cards */
    .perm-card {
      border: 1px solid #e9ecef;
      transition: border-color .2s, box-shadow .2s;
    }
    .perm-card:hover {
      border-color: #6610f2;
      box-shadow: 0 4px 12px rgba(102,16,242,0.15);
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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
  <div class="card shadow-lg rounded-3 card-form">
    <div class="card-header bg-gradient-primary text-white d-flex align-items-center">
      <h4 class="mb-0">
        <i class="bi bi-shield-lock-fill me-2"></i>
        <?php echo e(isset($role) ? 'Edit Role' : 'New Role'); ?>

      </h4>
      <a href="<?php echo e(route('admin.roles.index')); ?>"
         class="btn btn-light-primary btn-sm ms-auto d-flex align-items-center">
        <i class="bi bi-arrow-left me-1"></i>
        Back to Roles
      </a>
    </div>

    <div class="card-body p-4">
      <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
          <i class="bi bi-exclamation-triangle-fill me-2 fs-4"></i>
          <div>
            <ul class="mb-0">
              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($e); ?></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
          <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>

      <form method="POST"
            action="<?php echo e(isset($role) ? route('admin.roles.update', $role) : route('admin.roles.store')); ?>">
        <?php echo csrf_field(); ?>
        <?php if(isset($role)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

        <div class="mb-4 form-floating">
          <input
            type="text"
            id="name"
            name="name"
            class="form-control"
            value="<?php echo e(old('name', $role->name ?? '')); ?>"
            required
          >
          <label for="name">
            <i class="bi bi-tag-fill me-1"></i>
            Role Name
          </label>
        </div>

        <div class="mb-4">
          <label class="form-label fw-semibold d-block mb-3">
            <i class="bi bi-lock-fill me-1"></i>
            Permissions
          </label>
          <div class="row gy-3">
            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $checked = old('permissions')
                  ? in_array($perm->name, old('permissions'))
                  : (isset($rolePermissions) && in_array($perm->name, $rolePermissions));
              ?>
              <div class="col-6 col-md-4 col-lg-3">
                <div class="card perm-card h-100 shadow-sm">
                  <div class="card-body d-flex align-items-center">
                    <input
                      class="form-check-input me-2"
                      type="checkbox"
                      id="perm-<?php echo e($perm->id); ?>"
                      name="permissions[]"
                      value="<?php echo e($perm->name); ?>"
                      <?php echo e($checked ? 'checked' : ''); ?>

                    >
                    <label
                      class="form-check-label mb-0 text-truncate"
                      for="perm-<?php echo e($perm->id); ?>"
                    >
                      <?php echo e(ucfirst($perm->name)); ?>

                    </label>
                  </div>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>

        <div class="d-flex justify-content-end">
          <button type="submit" class="btn btn-success me-2 d-flex align-items-center">
            <i class="bi bi-save-fill me-1"></i>
            <?php echo e(isset($role) ? 'Update Role' : 'Create Role'); ?>

          </button>
          <a href="<?php echo e(route('admin.roles.index')); ?>"
             class="btn btn-outline-secondary d-flex align-items-center">
            <i class="bi bi-x-circle-fill me-1"></i>
            Cancel
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/htdocs/casino/resources/views/admin/roles/create.blade.php ENDPATH**/ ?>