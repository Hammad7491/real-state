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
    <li>
      <a href="<?php echo e(route('user.profile.create')); ?>">
        <div class="parent-icon">
          <i class='bx bx-user-circle'></i>
        </div>
        <div class="menu-title">Profile</div>
      </a>
    </li>
    <li>
      <a href="<?php echo e(route('user.products.view')); ?>">
        <div class="parent-icon">
          <i class='bx bx-user-circle'></i>
        </div>
        <div class="menu-title">Products</div>
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
  </ul>
</div>
<?php /**PATH /Applications/XAMPP/htdocs/kunaki/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>