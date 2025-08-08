<?php $__env->startSection('title'); ?> Matches for <?php echo e($buyer->name); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
  
  <div class="mb-4">
    <h2 class="mb-1">Matches for <strong><?php echo e($buyer->name); ?></strong></h2>
    <p class="mb-0">
      <small>Email: <a href="mailto:<?php echo e($buyer->email); ?>"><?php echo e($buyer->email); ?></a>
      | Phone: <?php echo e($buyer->phone ?? '—'); ?></small>
    </p>
    <?php if($buyer->notes): ?>
      <p class="mt-2"><em>Notes:</em> <?php echo e($buyer->notes); ?></p>
    <?php endif; ?>
    <a href="<?php echo e(route('admin.matching.pending')); ?>" class="btn btn-link px-0">&larr; Back to Pending</a>
  </div>

  <?php $__empty_1 = true; $__currentLoopData = $matches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php $s = $info['seller']; $hits = $info['matched']; ?>

    <div class="row mb-4 p-3 border rounded shadow-sm">
      
      <div class="col-md-6">
        <h5 class="mb-3"><i class="bx bx-home-alt me-1"></i> Seller: <?php echo e($s->name); ?></h5>
        <p class="mb-1"><strong>Email:</strong> <a href="mailto:<?php echo e($s->email); ?>"><?php echo e($s->email); ?></a></p>
        <p class="mb-1"><strong>Phone:</strong> <?php echo e($s->phone ?? '—'); ?></p>
        <hr>
        <h6>Property Details</h6>
        <p class="mb-1">
          <strong>Address:</strong><br>
          <?php echo e($s->property_address); ?>,<br>
          <?php echo e($s->property_city); ?>, <?php echo e($s->property_state); ?> <?php echo e($s->property_zip); ?>

        </p>
        <p class="mb-1">
          <strong>Type:</strong> <?php echo e($s->property_type); ?><br>
          <strong>Price:</strong> $<?php echo e(number_format($s->asking_price)); ?><br>
          <strong>Beds:</strong> <?php echo e($s->bedrooms ?? '—'); ?>

          |
          <strong>Baths:</strong> <?php echo e($s->bathrooms ?? '—'); ?><br>
          <strong>Sqft:</strong> <?php echo e($s->square_footage ?? '—'); ?>

        </p>
        <?php if($s->additional_details): ?>
          <p class="mt-2"><em><?php echo e($s->additional_details); ?></em></p>
        <?php endif; ?>
      </div>

      
      <div class="col-md-6 border-start ps-4">
        <h6><i class="bx bx-list-ul me-1"></i> Buyer’s Criteria</h6>
        <ul class="mb-3">
          <?php $__currentLoopData = $buyer->criteria; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
              <code><?php echo e($c->field); ?> <?php echo e($c->operator); ?> <?php echo e($c->value); ?></code>
              <?php if(in_array(
                   "{$c->field} {$c->operator} {$c->value}",
                   $hits,
                   true
                 )): ?>
                <span class="badge bg-success ms-2">✔ Matched</span>
              <?php else: ?>
                <span class="badge bg-secondary ms-2">✘</span>
              <?php endif; ?>
            </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        <h6><i class="bx bx-check-circle me-1"></i> Actually Matched</h6>
        <?php if(count($hits)): ?>
          <ul>
            <?php $__currentLoopData = $hits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($hit); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        <?php else: ?>
          <p><em>No criteria matched (shouldn’t happen here).</em></p>
        <?php endif; ?>
      </div>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="alert alert-warning">
      No sellers match <strong><?php echo e($buyer->name); ?></strong>’s criteria.
    </div>
  <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/htdocs/real-estate/resources/views/admin/matchings/show.blade.php ENDPATH**/ ?>