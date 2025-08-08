<div class="sidebar-wrapper" data-simplebar="true">
  <div class="sidebar-header">
    <div>
      <img src="<?php echo e(asset('assets/images/logo-icon.png')); ?>" class="logo-icon" alt="logo icon">
    </div>
    <div>
      <h4 class="logo-text">Dashtrans</h4>
    </div>
    <div class="toggle-icon ms-auto">
      <i class='bx bx-arrow-back'></i>
    </div>
  </div>
  <!--navigation-->
  <ul class="metismenu" id="menu">
    <li>
      <a href="<?php echo e(route('admin.dashboard')); ?>">
        <div class="parent-icon">
          <i class='bx bx-bar-chart-alt-2'></i>
        </div>
        <div class="menu-title">Dashboard</div>
      </a>
    </li>

    <li class="menu-label">Users</li>
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon">
          <i class='bx bx-user'></i>
        </div>
        <div class="menu-title">User Management</div>
      </a>
      <ul>
        <li>
          <a href="<?php echo e(route('admin.users.create')); ?>">
            <i class='bx bx-user-plus'></i>
            Add User
          </a>
        </li>
        <li>
          <a href="<?php echo e(route('admin.users.index')); ?>">
            <i class='bx bx-user'></i>
            Users List
          </a>
        </li>
        <li>
          <a href="<?php echo e(route('admin.roles.index')); ?>">
            <i class='bx bx-shield-quarter'></i>
            Roles &amp; Permissions
          </a>
        </li>
        <li>
          <a href="<?php echo e(route('admin.permissions.index')); ?>">
            <i class='bx bx-lock-open-alt'></i>
            Permissions
          </a>
        </li>
      </ul>
    </li>



    
    <li class="menu-label">Users</li>
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon">
          <i class='bx bx-user'></i>
        </div>
        <div class="menu-title">Buyer Management</div>
      </a>
      <ul>
  
        <li>
          <a href="<?php echo e(route('admin.buyers.create')); ?>">
            <i class='bx bx-lock-open-alt'></i>
            Create Buyer
          </a>
        </li>
        <li>
          <a href="<?php echo e(route('admin.buyers.index')); ?>">
            <i class='bx bx-lock-open-alt'></i>
             Buyer List
          </a>
        </li>
      </ul>
    </li>


 
    <li class="menu-label">Matching</li>
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon">
          <i class='bx bx-user'></i>
        </div>
        <div class="menu-title">Matching Management</div>
      </a>
      <ul>
  
        <li>
          <a href="<?php echo e(route('admin.matching.pending')); ?>">
            <i class='bx bx-lock-open-alt'></i>
           Pending Matching
          </a>
        </li>
        <li>
          <a href="<?php echo e(route('admin.buyers.index')); ?>">
            <i class='bx bx-lock-open-alt'></i>
            Accepted Matching
          </a>
        </li>
        <li>
          <a href="<?php echo e(route('admin.buyers.index')); ?>">
            <i class='bx bx-lock-open-alt'></i>
            Rejected Matching
          </a>
        </li>
      </ul>
    </li>


 













    




















  </ul>
</div>
<?php /**PATH /home/u407959809/domains/realestate.codefixxer.com/public_html/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>