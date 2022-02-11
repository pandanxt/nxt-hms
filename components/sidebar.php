<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/medeast-logo-icon.png" alt="MedEast Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MedEast Healthcare</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-1 pb-1 mb-1 d-flex">
        <div class="image pro-set">
          <img src="dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <?php if (isset($_SESSION['userid'])) { 
            echo '<a href="view_user.php?id='.$_SESSION['userid'].'" class="d-block">'.$_SESSION['name'].'</a>';
          }else{
            echo '<a href="profile.php" class="d-block">Mobeen Shah</a>';
          } ?>
          <button type="button" class="btn badge badge-danger" data-toggle="modal" data-target="#modal-sm">Logout</button>
        </div>
        
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

       <!-- Sidebar Menu -->
       <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
                <a href="bill.php" class="nav-link">
                <i class="nav-icon fas fa-file-invoice"></i>
                <p>Bill Details</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="patients.php" class="nav-link">
                <i class="nav-icon fas fa-hospital-user"></i>
                <p>Patient Details</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="doctors.php" class="nav-link">
                <i class="nav-icon fas fa-user-md"></i>
                <p>Doctor Details</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="dept.php" class="nav-link">
                <i class="nav-icon fas fa-building"></i>
                <p>Departments</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="services.php" class="nav-link">
                <i class="nav-icon fas fa-hand-holding-medical"></i>
                <p>Services</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="users.php" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Users</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>Settings<i class="right fas fa-angle-left"></i></p>
                </a>
                <?php if (isset($_SESSION['userid'])) { ?>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="view_user.php?id=<?php echo $_SESSION['userid']; ?>" class="nav-link">
                        <i class="nav-icon fas fa-user-alt"></i>
                        <p>Profile</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="add_user.php?id=<?php echo $_SESSION['userid']; ?>" class="nav-link">
                        <i class="nav-icon fas fa-user-edit"></i>
                        <p>Edit Profile</p>
                        </a>
                    </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a href="change_password.php" class="nav-link">
                        <i class="nav-icon fas fa-unlock-alt"></i>
                        <p>Change Password</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="patient_type.php" class="nav-link">
                        <i class="nav-icon fas fa-procedures"></i>
                        <p>Patient Type</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="education.php" class="nav-link">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>Doctor Education</p>
                        </a>
                    </li>
                    <?php if (isset($_SESSION['userid'])) { ?>
                    <li class="nav-item">
                        <a type="button" class="nav-link" data-toggle="modal" data-target="#modal-sm">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Confirm To Logout</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you Sure? You want to Logout&hellip;</p>
              <p>Or click <b>Cancel</b> to continue &hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <a type="submit" href="logout.php" class="btn btn-danger">Log Out</a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->