<?php $__env->startPush('styles'); ?>
<style>
  .bg-gradient-primary {
    background: linear-gradient(45deg, #0d6efd, #6610f2)!important;
  }
  .form-control:focus {
    box-shadow: 0 0 0 .2rem rgba(13,110,253,.25);
  }
  .btn-light-primary {
    color: #0d6efd;
    background-color: #f0f5ff;
    border: 1px solid #0d6efd;
  }
  .btn-light-primary:hover {
    background-color: #e2ecff;
  }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
  <div class="card shadow-lg rounded-3">
    <div class="card-header bg-gradient-primary text-white d-flex align-items-center">
      <h4 class="mb-0">
        <i class="bx bx-user-circle me-2"></i>
        <?php echo e(isset($profile) ? 'Edit Profile' : 'Create Profile'); ?>

      </h4>
    </div>
    <div class="card-body p-4">
      <?php if(session('success')): ?>
        <div class="alert alert-success d-flex align-items-center">
          <i class="bx bx-check-circle me-2 fs-4"></i><?php echo e(session('success')); ?>

        </div>
      <?php endif; ?>

      <form
        action="<?php echo e(isset($profile) ? route('user.profile.update', $profile) : route('user.profile.store')); ?>"
        method="POST"
        enctype="multipart/form-data"
      >
        <?php echo csrf_field(); ?>
        <?php if(isset($profile)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

        <div class="row g-3 mb-4">
          <div class="col-md-4 text-center">
            <img
              src="<?php echo e($profile->photo_url ?? asset('default-avatar.png')); ?>"
              class="rounded-circle mb-2"
              width="120" height="120"
            >
            <input type="file" name="photo" class="form-control mt-2">
          </div>

          <div class="col-md-8">
            <div class="form-floating mb-3">
              <input
                type="text"
                class="form-control"
                value="<?php echo e(Auth::user()->name); ?>"
                disabled
              >
              <label><i class="bx bx-user me-1"></i>Name</label>
            </div>
            <div class="form-floating mb-3">
              <input
                type="email"
                class="form-control"
                value="<?php echo e(Auth::user()->email); ?>"
                disabled
              >
              <label><i class="bx bx-envelope me-1"></i>Email</label>
            </div>

            <label class="form-label fw-semibold"><i class="bx bx-globe me-1"></i>Social Links</label>
            <div class="row g-2 mb-3">
              <?php $__currentLoopData = ['twitter','instagram','facebook','youtube']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-6">
                  <div class="input-group">
                    <span class="input-group-text">
                      <i class="bx bxl-<?php echo e($platform); ?> fs-5"></i>
                    </span>
                    <input
                      type="url"
                      name="social_links[<?php echo e($platform); ?>]"
                      value="<?php echo e(old("social_links.$platform", $profile->social_links[$platform] ?? '')); ?>"
                      class="form-control"
                      placeholder="<?php echo e(ucfirst($platform)); ?> URL"
                    >
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </div>

        <hr>

        <div class="row g-3 mb-4">
          <div class="col-md-6 form-floating">
            <input
              type="text"
              name="solana_wallet"
              value="<?php echo e(old('solana_wallet', $profile->solana_wallet ?? '')); ?>"
              class="form-control"
            >
            <label><i class="bx bx-wallet me-1"></i>Solana Wallet</label>
          </div>
          <div class="col-md-6 form-floating">
            <input
              type="email"
              name="paypal_email"
              value="<?php echo e(old('paypal_email', $profile->paypal_email ?? '')); ?>"
              class="form-control"
            >
            <label><i class="bx bxl-paypal me-1"></i>PayPal PYUSD Email</label>
          </div>
          <div class="col-md-6 form-floating">
            <input
              type="text"
              name="kunaki_username"
              value="<?php echo e(old('kunaki_username', $profile->kunaki_username ?? '')); ?>"
              class="form-control"
            >
            <label><i class="bx bx-user me-1"></i>Kunaki Username</label>
          </div>
          <div class="col-md-6 form-floating">
            <input
              type="text"
              name="kunaki_api_key"
              value="<?php echo e(old('kunaki_api_key', $profile->kunaki_api_key ?? '')); ?>"
              class="form-control"
            >
            <label><i class="bx bx-key me-1"></i>Kunaki API Key</label>
          </div>
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-light-primary">
            <i class="bx bx-save me-1"></i>
            <?php echo e(isset($profile) ? 'Update Profile' : 'Save Profile'); ?>

          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/htdocs/kunaki/resources/views/user/profile/create.blade.php ENDPATH**/ ?>