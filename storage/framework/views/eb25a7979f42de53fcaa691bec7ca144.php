<?php $__env->startSection('title', isset($user) ? 'Edit User' : 'New User'); ?>

<?php $__env->startPush('styles'); ?>
  <!-- Select2 CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
    rel="stylesheet"
  />
  <link
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"
    rel="stylesheet"
  />

  <style>
    /* make the container always full-width */
    .select2-container--bootstrap-5 {
      width: 100% !important;
    }

    /* transparent background & inherit form-control height/padding */
    .select2-container--bootstrap-5 .select2-selection--multiple,
    .select2-container--bootstrap-5 .select2-selection--single {
      background-color: transparent !important;
      border: 1px solid #ced4da;
      min-height: calc(1.5em + .75rem + 2px);
      padding: .375rem .75rem;
    }

    /* remove that extra arrow padding so it lines up perfectly */
    .select2-container--bootstrap-5 .select2-selection__rendered {
      padding: 0;
    }
  </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
        <div class="col-xl-7 mx-auto mt-4">
          <div class="card border-top border-4 border-white shadow-sm mb-4">
            <div class="card-body p-5">
              <div class="card-title d-flex align-items-center mb-4">
                <i class="bx bxs-user me-2 fs-3 text-primary"></i>
                <h5 class="mb-0"><?php echo e(isset($user) ? 'Edit User' : 'User Registration'); ?></h5>
              </div>

              <form
                class="row g-3"
                method="POST"
                action="<?php echo e(isset($user)
                            ? route('admin.users.update', $user)
                            : route('admin.users.store')); ?>"
              >
                <?php echo csrf_field(); ?>
                <?php if(isset($user)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

                <div class="col-md-6 form-floating">
                  <input
                    type="text"
                    name="name"
                    id="inputFirstName"
                    class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    value="<?php echo e(old('name', $user->name ?? '')); ?>"
                    required
                  >
                  <label for="inputFirstName">First Name</label>
                  <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-6 form-floating">
                  <input
                    type="text"
                    name="last_name"
                    id="inputLastName"
                    class="form-control <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    value="<?php echo e(old('last_name', $user->last_name ?? '')); ?>"
                    required
                  >
                  <label for="inputLastName">Last Name</label>
                  <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-6 form-floating">
                  <input
                    type="email"
                    name="email"
                    id="inputEmail"
                    class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    value="<?php echo e(old('email', $user->email ?? '')); ?>"
                    required
                  >
                  <label for="inputEmail">Email address</label>
                  <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-6 form-floating">
                  <input
                    type="password"
                    name="password"
                    id="inputPassword"
                    class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    <?php echo e(isset($user) ? '' : 'required'); ?>

                  >
                  <label for="inputPassword">
                    <?php echo e(isset($user) ? 'New Password (leave blank to keep)' : 'Password'); ?>

                  </label>
                  <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
      <div class="col-12 mb-4">
      <label for="roles" class="form-label">
        <i class="bx bx-shield-quarter me-1"></i>
        Roles
      </label>
      <select
        name="roles[]"
        id="roles"
        class="form-select <?php $__errorArgs = ['roles'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
        multiple
        required
      >
        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option
            value="<?php echo e($role->name); ?>"
            <?php echo e(in_array($role->name, old('roles', $userRoles ?? [])) ? 'selected' : ''); ?>

          >
            <?php echo e(ucfirst($role->name)); ?>

          </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <?php $__errorArgs = ['roles'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback"><?php echo e($message); ?></div>
      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
                <div class="col-12 text-end">
                  <button type="submit" class="btn btn-primary px-5">
                    <i class="bx bx-save me-1"></i>
                    <?php echo e(isset($user) ? 'Update' : 'Register'); ?>

                  </button>
                  <a
                    href="<?php echo e(route('admin.users.index')); ?>"
                    class="btn btn-light ms-2"
                  >
                    <i class="bx bx-arrow-back me-1"></i>Cancel
                  </a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <!-- Select2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $(function() {
      $('#roles').select2({
        theme: 'bootstrap-5',
        width: '100%',
        allowClear: true
      });
    });
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/htdocs/kunaki/resources/views/admin/users/create.blade.php ENDPATH**/ ?>