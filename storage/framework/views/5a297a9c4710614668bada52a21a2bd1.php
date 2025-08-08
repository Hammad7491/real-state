
<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--favicon-->
	<link rel="icon" href="<?php echo e(asset('assets/images/favicon-32x32.png')); ?>" type="image/png" />

	<!--plugins-->
	<link href="<?php echo e(asset('assets/plugins/simplebar/css/simplebar.css')); ?>" rel="stylesheet" />
	<link href="<?php echo e(asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')); ?>" rel="stylesheet" />
	<link href="<?php echo e(asset('assets/plugins/metismenu/css/metisMenu.min.css')); ?>" rel="stylesheet" />
	<!-- loader-->
	<link href="<?php echo e(asset('assets/css/pace.min.css')); ?>" rel="stylesheet" />
	<script src="<?php echo e(asset('assets/js/pace.min.js')); ?>"></script>
	<!-- Bootstrap CSS -->
	<link href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('assets/css/bootstrap-extended.css')); ?>" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="<?php echo e(asset('assets/css/app.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('assets/css/icons.css')); ?>" rel="stylesheet">
	<title>Dashtrans - Bootstrap5 Admin Template</title>
</head>

<body class="bg-theme bg-theme2">
    <div class="wrapper">
        <div class="section-authentication-cover">
            <div class="row g-0">
                <!-- left image pane -->
                <div class="col-xl-7 d-none d-xl-flex">
                    <!-- ... -->
                </div>
                <!-- right login pane -->
                <div class="col-xl-5 bg-light">
                    <div class="card m-3 bg-transparent">
                        <div class="card-body p-sm-5">
                            <div class="text-center mb-4">
                                <img src="<?php echo e(asset('assets/images/logo-icon.png')); ?>" width="60" alt="">
                                <h5 class="mt-3">Dashtrans Admin</h5>
                                <p>Please log in to your account</p>
                            </div>

                            <?php if($errors->any()): ?>
                              <div class="alert alert-danger">
                                <ul class="mb-0">
                                  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($e); ?></li>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                              </div>
                            <?php endif; ?>

                            <form method="POST" action="<?php echo e(route('login')); ?>" class="row g-3" id="loginForm">
                              <?php echo csrf_field(); ?>

                              <div class="col-12">
                                <label class="form-label">Email</label>
                                <input
                                  type="email"
                                  name="email"
                                  class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                  placeholder="jhon@example.com"
                                  value="<?php echo e(old('email')); ?>"
                                  required
                                >
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

                              <div class="col-12">
                                <label class="form-label">Password</label>
                                <div class="input-group" id="show_hide_password">
                                  <input
                                    type="password"
                                    name="password"
                                    class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    placeholder="Enter Password"
                                    required
                                  >
                                  <a href="javascript:;" class="input-group-text bg-transparent">
                                    <i class="bx bx-hide"></i>
                                  </a>
                                  <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-check form-switch">
                                  <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="remember"
                                    <?php echo e(old('remember') ? 'checked' : ''); ?>

                                  >
                                  <label class="form-check-label">Remember Me</label>
                                </div>
                              </div>

                              <div class="col-md-6 text-end">
                                <a href="#">Forgot Password?</a>
                              </div>

                              <div class="col-12">
                                <div class="d-grid mb-2">
                                  <button type="submit" class="btn btn-light">Sign in</button>
                                </div>
                                <div class="d-grid">
                                  <button
                                    type="button"
                                    class="btn btn-secondary"
                                    onclick="fillLogin('a@a','a')"
                                  >
                                    Quick Admin Login
                                  </button>
                                </div>
                              </div>

                              <div class="col-12 text-center">
                                <p class="mb-0">
                                  Don't have an account?
                                  <a href="<?php echo e(route('registerform')); ?>">Sign up here</a>
                                </p>
                              </div>
                            </form>

                            <div class="login-separater text-center mb-5">
                              <span>OR SIGN IN WITH</span>
                              <hr>
                            </div>
                            <div class="text-center">
                              <a href="<?php echo e(route('facebook.login')); ?>" class="btn btn-light me-2">
                                <i class="bx bxl-facebook"></i>
                              </a>
                              <a href="<?php echo e(route('google.login')); ?>" class="btn btn-light">
                                <i class="bx bxl-google"></i>
                              </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"></script>
    <script>
      // toggle password visibility
      $('#show_hide_password a').on('click', function(e) {
        e.preventDefault();
        let input = $('#show_hide_password input'),
            icon  = $('#show_hide_password i');
        if (input.attr('type') === 'password') {
          input.attr('type','text');
          icon.removeClass('bx-hide').addClass('bx-show');
        } else {
          input.attr('type','password');
          icon.addClass('bx-hide').removeClass('bx-show');
        }
      });

      // quick-fill & submit
      function fillLogin(email, pass) {
        document.querySelector('input[name="email"]').value    = email;
        document.querySelector('input[name="password"]').value = pass;
        document.getElementById('loginForm').submit();
      }
    </script>
    <script src="<?php echo e(asset('assets/js/app.js')); ?>"></script>
</body>
</html>
<?php /**PATH /Applications/XAMPP/htdocs/real-estate/resources/views/auth/login.blade.php ENDPATH**/ ?>