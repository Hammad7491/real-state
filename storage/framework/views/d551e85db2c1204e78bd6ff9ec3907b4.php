<?php $__env->startSection('title', 'Form Layouts'); ?>

<?php $__env->startSection('content'); ?>
    <!--breadcrumb-->  
    
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-xl-7 mx-auto mt-4">
            <!-- Basic Form -->
           
            <div class="card border-top border-4 border-white  shadow-sm mb-4">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center mb-4">
                        <i class="bx bxs-user me-2 fs-3 text-primary"></i>
                        <h5 class="mb-0">User Registration</h5>
                    </div>
             <form class="row g-3">
  <div class="col-md-6">
    <div class="form-floating">
      <input type="text" class="form-control" id="inputFirstName" placeholder=" ">
      <label for="inputFirstName">First Name</label>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-floating">
      <input type="text" class="form-control" id="inputLastName" placeholder=" ">
      <label for="inputLastName">Last Name</label>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-floating">
      <input type="email" class="form-control" id="inputEmail" placeholder=" ">
      <label for="inputEmail">Email address</label>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-floating">
      <input type="password" class="form-control" id="inputPassword" placeholder=" ">
      <label for="inputPassword">Password</label>
    </div>
  </div>
  <div class="col-12">
    <div class="form-floating">
      <textarea class="form-control" id="inputAddress" placeholder=" " style="height: 100px"></textarea>
      <label for="inputAddress">Address</label>
    </div>
  </div>
  <!-- ...and so on for the rest of your fields... -->
  <div class="col-12">
    <button class="btn btn-primary px-5" type="submit">Register</button>
  </div>
</form>

                </div>
            </div>
            <!-- End Basic Form -->

            <!-- Additional form sections (Form with Icons, Login Form, Horizontal Form) can be added below following the same pattern -->
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/htdocs/casino/resources/views/admin/users/create.blade.php ENDPATH**/ ?>