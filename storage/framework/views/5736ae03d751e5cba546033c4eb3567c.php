<?php $__env->startSection('title', $buyer->exists ? 'Edit Buyer' : 'New Buyer'); ?>

<?php $__env->startPush('styles'); ?>
<style>
  /* ensure the remove-button sits neatly in the row */
  .criteria-row { position: relative; }
  .criteria-row .remove-criteria {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
  }
   .remove-criteria {
    line-height: 1;
    font-size: 1.2rem;
  }

  
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-content">
  <div class="row">
    <div class="col-xl-10 mx-auto mt-4">
      <div class="card shadow-sm mb-4">
        <div class="card-body p-5">
          <h4 class="card-title mb-4">
            <i class="bx bx-user-plus fs-3 text-primary me-2"></i>
            <?php echo e($buyer->exists ? 'Edit Buyer' : 'New Buyer'); ?>

          </h4>

          <form method="POST"
                action="<?php echo e($buyer->exists
                           ? route('admin.buyers.update', $buyer)
                           : route('admin.buyers.store')); ?>">
            <?php echo csrf_field(); ?>
            <?php if($buyer->exists): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

            
            <div class="row g-3 mb-4">
              <div class="col-md-6 form-floating">
                <input type="text" name="name" id="inputName"
                       class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       value="<?php echo e(old('name', $buyer->name)); ?>"
                       placeholder=" " required>
                <label for="inputName">Name</label>
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
              <div class="col-md-6 form-floating">
                <input type="email" name="email" id="inputEmail"
                       class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       value="<?php echo e(old('email', $buyer->email)); ?>"
                       placeholder=" " required>
                <label for="inputEmail">Email</label>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
              <div class="col-md-6 form-floating">
                <input type="text" name="phone" id="inputPhone"
                       class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       value="<?php echo e(old('phone', $buyer->phone)); ?>"
                       placeholder=" ">
                <label for="inputPhone">Phone</label>
                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
              <div class="col-12 form-floating">
                <textarea name="notes" id="inputNotes"
                          class="form-control <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                          style="height:100px" placeholder=" "><?php echo e(old('notes', $buyer->notes)); ?></textarea>
                <label for="inputNotes">Notes</label>
                <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>

            
            <h6 class="mb-3">Criteria</h6>
            <?php
              $existing = old(
                'criteria',
                $buyer->exists
                  ? $buyer->criteria->toArray()
                  : [[ 'field'=>'', 'operator'=>'', 'value'=>'', 'weight'=>1 ]]
              );
            ?>

            <div id="criteria-container">
              <?php $__currentLoopData = $existing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="criteria-row row g-3 mb-3">
                  <div class="col-md-3 form-floating">
                    <select name="criteria[<?php echo e($i); ?>][field]"
                            class="form-select <?php $__errorArgs = ['criteria.'.$i.'.field'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            required>
                      <option value="" disabled <?php echo e($c['field']=='' ? 'selected' : ''); ?>>Field</option>
                      <option value="location"       <?php echo e($c['field']=='location'       ? 'selected' : ''); ?>>Location</option>
                      <option value="price"          <?php echo e($c['field']=='price'          ? 'selected' : ''); ?>>Price</option>
                      <option value="property_type"  <?php echo e($c['field']=='property_type'  ? 'selected' : ''); ?>>Property Type</option>
                      <option value="bedrooms"       <?php echo e($c['field']=='bedrooms'       ? 'selected' : ''); ?>>Bedrooms</option>
                      <option value="bathrooms"      <?php echo e($c['field']=='bathrooms'      ? 'selected' : ''); ?>>Bathrooms</option>
                      <option value="square_footage" <?php echo e($c['field']=='square_footage' ? 'selected' : ''); ?>>Sq. Footage</option>
                    </select>
                    <label>Field</label>
                    <?php $__errorArgs = ['criteria.'.$i.'.field'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>

                  <div class="col-md-2 form-floating">
                    <select name="criteria[<?php echo e($i); ?>][operator]"
                            class="form-select <?php $__errorArgs = ['criteria.'.$i.'.operator'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            required>
                      <option value="" disabled <?php echo e($c['operator']=='' ? 'selected' : ''); ?>>Op</option>
                      <option value=">=" <?php echo e($c['operator']=='>=' ? 'selected' : ''); ?>>≥</option>
                      <option value="<=" <?php echo e($c['operator']=='<=' ? 'selected' : ''); ?>>≤</option>
                      <option value="="  <?php echo e($c['operator']=='='  ? 'selected' : ''); ?>>=</option>
                      <option value="IN" <?php echo e($c['operator']=='IN' ? 'selected' : ''); ?>>IN</option>
                    </select>
                    <label>Operator</label>
                    <?php $__errorArgs = ['criteria.'.$i.'.operator'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>

                  <div class="col-md-4 form-floating">
                    <input type="text"
                           name="criteria[<?php echo e($i); ?>][value]"
                           class="form-control <?php $__errorArgs = ['criteria.'.$i.'.value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           value="<?php echo e($c['value']); ?>"
                           placeholder=" " required>
                    <label>Value</label>
                    <?php $__errorArgs = ['criteria.'.$i.'.value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>

                  <div class="col-md-2 form-floating">
                    <input type="number"
                           name="criteria[<?php echo e($i); ?>][weight]"
                           class="form-control <?php $__errorArgs = ['criteria.'.$i.'.weight'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           min="1" max="10"
                           value="<?php echo e($c['weight']); ?>"
                           placeholder=" " required>
                    <label>Weight</label>
                    <?php $__errorArgs = ['criteria.'.$i.'.weight'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                  <div class="col-md-1 form-floating">

                  <button type="button" class="btn btn-danger" title="Remove">&times;</button>
                </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <button type="button" id="add-criteria" class="btn btn-secondary mb-4">
              + Add Another Rule
            </button>

            
            <div class="text-end">
              <button type="submit" class="btn btn-success px-5">
                <i class="bx bx-save me-1"></i>
                <?php echo e($buyer->exists ? 'Update Buyer' : 'Save Buyer'); ?>

              </button>
              <a href="<?php echo e(route('admin.buyers.index')); ?>" class="btn btn-light ms-2">
                <i class="bx bx-arrow-back me-1"></i>Cancel
              </a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
  $(function(){
    // current number of rows
    let idx = <?php echo e(count($existing)); ?>;

    $('#add-criteria').on('click', function(){
      const $new = $('.criteria-row:first').clone();
      // reset each field and bump the index
      $new.find('select, input').each(function(){
        const name = $(this).attr('name').replace(/\[\d+\]/, '['+idx+']');
        $(this).attr('name', name).val('');
      });
      // clear validation classes
      $new.find('.is-invalid').removeClass('is-invalid');
      $('#criteria-container').append($new);
      idx++;
    });

    // remove a row (but leave at least one)
    $(document).on('click', '.remove-criteria', function(){
      if ($('#criteria-container .criteria-row').length > 1) {
        $(this).closest('.criteria-row').remove();
      }
    });
  });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u407959809/domains/realestate.codefixxer.com/public_html/resources/views/admin/buyers/create.blade.php ENDPATH**/ ?>