<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?></title>

  <!-- Plugins CSS -->
  <link href="<?php echo e(asset('assets/plugins/simplebar/css/simplebar.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/metismenu/css/metisMenu.min.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')); ?>" rel="stylesheet" />

  <!-- Bootstrap & App CSS -->
  <link href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('assets/css/bootstrap-extended.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('assets/css/app.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('assets/css/icons.css')); ?>" rel="stylesheet">

  <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="bg-theme bg-theme2">
  <div class="wrapper">
    <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="page-wrapper">
      <?php if($errors->any()): ?>
        <div class="alert alert-danger my-3">
          <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      <?php endif; ?>

      <?php echo $__env->yieldContent('content'); ?>
    </div>

    <footer class="page-footer">
      <p class="mb-0">Copyright © 2021. All right reserved.</p>
    </footer>
  </div>

  
  <script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/plugins/simplebar/js/simplebar.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/plugins/metismenu/js/metisMenu.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/plugins/datatable/js/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/index.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/app.js')); ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  
  <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /Applications/XAMPP/htdocs/real-estate/resources/views/layouts/app.blade.php ENDPATH**/ ?>