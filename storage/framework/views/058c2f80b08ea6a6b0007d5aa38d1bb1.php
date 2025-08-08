<?php $__env->startPush('styles'); ?>
<style>
  .bg-gradient-primary {
    background: linear-gradient(45deg, #0d6efd, #6610f2) !important;
  }
  .form-floating .form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(13,110,253,0.25);
  }
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
        <i class="bi bi-ticket-fill me-2"></i>
        New Code
      </h4>
    </div>
    <div class="card-body p-4">
      <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
          <i class="bi bi-exclamation-triangle-fill me-2 fs-4"></i>
          <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($err); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
          <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>

      <form action="<?php echo e(route('admin.codes.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="form-floating mb-4">
          <input type="text" id="code_string" name="code_string"
                 class="form-control" placeholder="Code String"
                 value="<?php echo e(old('code_string')); ?>" required>
          <label for="code_string">
            <i class="bi bi-ticket-fill me-1"></i>
            Code String
          </label>
        </div>

        <div class="form-floating mb-4">
          <input type="number" step="0.01" id="balance" name="balance"
                 class="form-control" placeholder="Initial Balance"
                 value="<?php echo e(old('balance')); ?>" required>
          <label for="balance">
            <i class="bi bi-currency-dollar me-1"></i>
            Initial Balance
          </label>
        </div>

        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" id="is_winner" name="is_winner"
                 <?php echo e(old('is_winner') ? 'checked' : ''); ?>>
          <label class="form-check-label" for="is_winner">
            Winning Code
          </label>
        </div>

        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" id="big_win_mode" name="big_win_mode"
                 <?php echo e(old('big_win_mode') ? 'checked' : ''); ?>>
          <label class="form-check-label" for="big_win_mode">
            Big-Win Mode
          </label>
        </div>

        <div class="form-floating mb-4">
          <select id="strength" name="strength" class="form-select" required>
            <option value="">Select Strength</option>
            <option value="weak"   <?php echo e(old('strength')=='weak'   ? 'selected' : ''); ?>>Weak</option>
            <option value="normal" <?php echo e(old('strength')=='normal' ? 'selected' : ''); ?>>Normal</option>
            <option value="strong" <?php echo e(old('strength')=='strong' ? 'selected' : ''); ?>>Strong</option>
          </select>
          <label for="strength">
            <i class="bi bi-sliders me-1"></i>
            Payout Strength
          </label>
        </div>

        <div class="form-floating mb-4">
          <input type="number" id="forced_spin" name="forced_spin"
                 class="form-control" placeholder="Forced Spin #"
                 value="<?php echo e(old('forced_spin')); ?>">
          <label for="forced_spin">
            <i class="bi bi-arrow-clockwise me-1"></i>
            Forced Win on Spin #
          </label>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-floating mb-4">
              <select id="prize_type" name="prize_type" class="form-select" required>
                <option value="fixed"     <?php echo e(old('prize_type')=='fixed'     ? 'selected':''); ?>>Fixed</option>
                <option value="percentage" <?php echo e(old('prize_type')=='percentage'? 'selected':''); ?>>Percentage</option>
              </select>
              <label for="prize_type">
                <i class="bi bi-tag-fill me-1"></i>
                Prize Type
              </label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating mb-4">
              <input type="number" step="0.01" id="prize_value" name="prize_value"
                     class="form-control" placeholder="Prize Value"
                     value="<?php echo e(old('prize_value')); ?>" required>
              <label for="prize_value">
                <i class="bi bi-percent me-1"></i>
                Prize Value
              </label>
            </div>
          </div>
        </div>

        <div class="d-flex justify-content-end">
          <button type="submit"
                  class="btn btn-success me-2 d-flex align-items-center">
            <i class="bi bi-save-fill me-1"></i>
            Create Code
          </button>
          <a href="<?php echo e(route('admin.codes.index')); ?>"
             class="btn btn-outline-secondary d-flex align-items-center">
            <i class="bi bi-arrow-left-circle-fill me-1"></i>
            Back to List
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/htdocs/casino/resources/views/admin/codes/create.blade.php ENDPATH**/ ?>