<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo e(isset($seller) ? 'Edit Your Listing' : 'Sell Your Property'); ?></title>

  <!-- Bootstrap 5 CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />

  <style>
    /* Hero styling */
    #hero {
      background: #0d6efd;
      color: white;
      padding: 4rem 0;
      text-align: center;
      position: relative;
    }
    #seller-form {
      padding: 3rem 0;
    }
    .creative-only {
      display: none;
    }
  </style>
</head>
<body>

  <!-- Hero Section -->
  <section id="hero">
    <div class="container">
      <a href="<?php echo e(route('login')); ?>"
         class="btn btn-outline-light position-absolute top-0 end-0 mt-4 me-3">
        Login
      </a>
      <h1 class="display-5 fw-bold">Landing Page</h1>
      <p class="lead">Tell us about your home and we’ll connect you with qualified buyers.</p>
    </div>
  </section>

  <!-- Seller Form Section -->
  <section id="seller-form">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">

          <div class="card shadow-sm">
            <div class="card-body p-4">
              <h2 class="h4 mb-4">
                <?php echo e(isset($seller) ? 'Edit Your Listing' : 'Your Property Details'); ?>

              </h2>

              <form method="POST"
                    action="<?php echo e(isset($seller)
                                ? route('sellers.update', $seller)
                                : route('sellers.store')); ?>">
                <?php echo csrf_field(); ?>
                <?php if(isset($seller)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

                <div class="row g-3">
                  <!-- Basic Seller Info -->
                  <div class="col-md-6">
                    <label class="form-label">Your Name</label>
                    <input type="text" name="name" class="form-control"
                           value="<?php echo e(old('name', $seller->name ?? '')); ?>" required>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control"
                           value="<?php echo e(old('email', $seller->email ?? '')); ?>" required>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Phone Number</label>
                    <input type="tel" name="phone" class="form-control"
                           value="<?php echo e(old('phone', $seller->phone ?? '')); ?>">
                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>

                  <!-- Property Address -->
                  <div class="col-md-6">
                    <label class="form-label">Property Address</label>
                    <input type="text" name="property_address" class="form-control"
                           value="<?php echo e(old('property_address', $seller->property_address ?? '')); ?>"
                           required>
                    <?php $__errorArgs = ['property_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">City</label>
                    <input type="text" name="property_city" class="form-control"
                           value="<?php echo e(old('property_city', $seller->property_city ?? '')); ?>" required>
                    <?php $__errorArgs = ['property_city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">State</label>
                    <input type="text" name="property_state" class="form-control"
                           value="<?php echo e(old('property_state', $seller->property_state ?? '')); ?>" required>
                    <?php $__errorArgs = ['property_state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">ZIP Code</label>
                    <input type="text" name="property_zip" class="form-control"
                           value="<?php echo e(old('property_zip', $seller->property_zip ?? '')); ?>" required>
                    <?php $__errorArgs = ['property_zip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>

                  <!-- Deal Type & Core Deal Fields -->
                  <div class="col-md-6">
                    <label class="form-label">Deal Type</label>
                    <select name="deal_type" class="form-select" required>
                      <?php $__currentLoopData = ['Cash','Subject-To','Seller-Finance','Hybrid']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($d); ?>"
                        <?php echo e(old('deal_type', $seller->deal_type ?? '') === $d ? 'selected' : ''); ?>>
                        <?php echo e($d); ?>

                      </option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['deal_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Asking Price</label>
                    <input type="number" name="asking_price" class="form-control"
                           value="<?php echo e(old('asking_price', $seller->asking_price ?? '')); ?>" required>
                    <?php $__errorArgs = ['asking_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>

                  <div class="col-md-4">
                    <label class="form-label">Bedrooms</label>
                    <input type="number" name="bedrooms" min="0" class="form-control"
                           value="<?php echo e(old('bedrooms', $seller->bedrooms ?? '')); ?>">
                    <?php $__errorArgs = ['bedrooms'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">Bathrooms</label>
                    <input type="number" name="bathrooms" step="0.5" class="form-control"
                           value="<?php echo e(old('bathrooms', $seller->bathrooms ?? '')); ?>">
                    <?php $__errorArgs = ['bathrooms'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">Square Footage</label>
                    <input type="number" name="square_footage" class="form-control"
                           value="<?php echo e(old('square_footage', $seller->square_footage ?? '')); ?>">
                    <?php $__errorArgs = ['square_footage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>

                  <!-- ROI / Entry Inputs (always shown) -->
                  <div class="col-md-4 form-floating">
                    <input type="number" name="arv" class="form-control"
                           value="<?php echo e(old('arv', $seller->arv ?? '')); ?>" required>
                    <label>ARV (After Repair Value)</label>
                    <?php $__errorArgs = ['arv'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                  <div class="col-md-4 form-floating">
                    <input type="number" name="estimated_repairs" class="form-control"
                           value="<?php echo e(old('estimated_repairs', $seller->estimated_repairs ?? '')); ?>">
                    <label>Estimated Repairs</label>
                  </div>
                  <div class="col-md-4 form-floating">
                    <input type="number" name="back_taxes" class="form-control"
                           value="<?php echo e(old('back_taxes', $seller->back_taxes ?? '')); ?>">
                    <label>Back Taxes</label>
                  </div>
                  <div class="col-md-4 form-floating">
                    <input type="number" name="title_liens" class="form-control"
                           value="<?php echo e(old('title_liens', $seller->title_liens ?? '')); ?>">
                    <label>Title Liens</label>
                  </div>
                  <div class="col-md-4 form-floating">
                    <input type="number" name="closing_costs" class="form-control"
                           value="<?php echo e(old('closing_costs', $seller->closing_costs ?? '')); ?>">
                    <label>Closing Costs</label>
                  </div>
                  <div class="col-md-4 form-floating">
                    <input type="number" name="transaction_coordinator_fees" class="form-control"
                           value="<?php echo e(old('transaction_coordinator_fees', $seller->transaction_coordinator_fees ?? '')); ?>">
                    <label>Coordinator Fees</label>
                  </div>

                  <!-- Creative-deal fields (hidden when Cash) -->
                  <div class="creative-only row g-3">
                    <div class="col-md-4 form-floating">
                      <input type="number" name="mortgage_balance" class="form-control"
                             value="<?php echo e(old('mortgage_balance', $seller->mortgage_balance ?? '')); ?>">
                      <label>Mortgage Balance</label>
                    </div>
                    <div class="col-md-4 form-floating">
                      <input type="number" name="monthly_piti" class="form-control"
                             value="<?php echo e(old('monthly_piti', $seller->monthly_piti ?? '')); ?>">
                      <label>Monthly PITI</label>
                    </div>
                    <div class="col-md-4 form-floating">
                      <input type="number" name="arrears" class="form-control"
                             value="<?php echo e(old('arrears', $seller->arrears ?? '')); ?>">
                      <label>Arrears</label>
                    </div>

                    <div class="col-md-4 form-floating">
                      <input type="number" name="cash_to_seller" class="form-control"
                             value="<?php echo e(old('cash_to_seller', $seller->cash_to_seller ?? '')); ?>">
                      <label>Cash to Seller</label>
                    </div>
                    <div class="col-md-4 form-floating">
                      <input type="number" name="down_payment" class="form-control"
                             value="<?php echo e(old('down_payment', $seller->down_payment ?? '')); ?>">
                      <label>Down Payment</label>
                    </div>
                    <div class="col-md-4 form-floating">
                      <input type="number" name="monthly_payment_to_seller" class="form-control"
                             value="<?php echo e(old('monthly_payment_to_seller', $seller->monthly_payment_to_seller ?? '')); ?>">
                      <label>Monthly Payment to Seller</label>
                    </div>

                    <div class="col-md-4 form-floating">
                      <input type="number" step="0.01" name="interest_rate" class="form-control"
                             value="<?php echo e(old('interest_rate', $seller->interest_rate ?? '')); ?>">
                      <label>Interest Rate (%)</label>
                    </div>
                    <div class="col-md-4 form-floating">
                      <input type="number" name="term_length" class="form-control"
                             value="<?php echo e(old('term_length', $seller->term_length ?? '')); ?>">
                      <label>Term Length</label>
                    </div>
                    <div class="col-md-4 form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="balloon" name="balloon"
                             value="1" <?php echo e(old('balloon', $seller->balloon ?? false) ? 'checked' : ''); ?>>
                      <label class="form-check-label" for="balloon">Balloon?</label>
                      <div class="mt-2 form-floating" style="max-width:150px;">
                        <input type="number" name="balloon_years" class="form-control"
                               value="<?php echo e(old('balloon_years', $seller->balloon_years ?? '')); ?>">
                        <label>Balloon Years</label>
                      </div>
                    </div>
                  </div>

                  <!-- Additional Details -->
                  <div class="col-12">
                    <label class="form-label">Additional Details</label>
                    <textarea name="additional_details" class="form-control" rows="4"
                    ><?php echo e(old('additional_details', $seller->additional_details ?? '')); ?></textarea>
                  </div>

                  <!-- Submit -->
                  <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary px-5">
                      <?php echo e(isset($seller) ? 'Update Seller' : 'Submit & Find Buyers'); ?>

                    </button>
                    <a href="<?php echo e(route('sellers.index')); ?>" class="btn btn-light ms-2">Cancel</a>
                  </div>
                </div>
              </form>

            </div><!-- /.card-body -->
          </div><!-- /.card -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section>

  <!-- Bootstrap 5 JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // show/hide creative inputs
    document.addEventListener('DOMContentLoaded', () => {
      const dealType = document.querySelector('select[name="deal_type"]');
      const creative = document.querySelectorAll('.creative-only');
      function toggle() {
        creative.forEach(el => el.style.display = dealType.value === 'Cash' ? 'none' : 'flex');
      }
      dealType.addEventListener('change', toggle);
      toggle();
    });
  </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\real\resources\views/welcome.blade.php ENDPATH**/ ?>