<?php $__env->startSection('title', isset($permission) ? 'Edit Permission' : 'New Permission'); ?>

<?php $__env->startPush('styles'); ?>
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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
  <div class="card shadow border-0 rounded-3">
    <div class="card-header bg-gradient-primary text-white d-flex align-items-center">
      <h4 class="mb-0">
        <i class="bx bx-key me-2"></i>
        <?php echo e(isset($permission) ? 'Edit Permission' : 'New Permission'); ?>

      </h4>
    </div>
    <div class="card-body p-4">
      <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
          <i class="bx bx-error me-2 fs-4"></i>
          <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($err); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
          <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>

      <form
        action="<?php echo e(isset($permission)
                   ? route('admin.permissions.update', $permission)
                   : route('admin.permissions.store')); ?>"
        method="POST"
      >
        <?php echo csrf_field(); ?>
        <?php if(isset($permission)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

        <div class="form-floating mb-4">
          <input
            type="text"
            id="name"
            name="name"
            class="form-control"
            value="<?php echo e(old('name', $permission->name ?? '')); ?>"
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
            <?php echo e(isset($permission) ? 'Update Permission' : 'Create Permission'); ?>

          </button>
          <a
            href="<?php echo e(route('admin.permissions.index')); ?>"
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/htdocs/casino/resources/views/admin/permissions/create.blade.php ENDPATH**/ ?>