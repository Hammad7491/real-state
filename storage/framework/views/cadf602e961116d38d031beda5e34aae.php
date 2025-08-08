<?php $__env->startSection('title','Pending Matches'); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
  <h2>Buyers with Matches</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Buyer</th>
        <th># Sellers</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php $__currentLoopData = $buyers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td>
          <strong><?php echo e($b->name); ?></strong><br>
          <small><?php echo e($b->email); ?></small>
        </td>
        <td><?php echo e($b->match_count); ?></td>
        <td>
          <a href="<?php echo e(route('admin.matching.show',$b)); ?>" class="btn btn-sm btn-primary">
            View Details
          </a>
        </td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
  </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u407959809/domains/realestate.codefixxer.com/public_html/resources/views/admin/matchings/pending.blade.php ENDPATH**/ ?>