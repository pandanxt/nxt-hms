<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="javascript:void(0);" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!------Home Icon------>
      <li class="nav-item d-none d-sm-inline-block">
        <a type="button" href="index.php" class="dropdown-item nav-link">
          <i class="fas fa-home"></i> Home
        </a>
      </li>
      <!------Create Slip Icon------>
      <li class="nav-item d-none d-sm-inline-block">
        <a type="button" class="dropdown-item nav-link" data-toggle="modal" data-target="#modal-slip">
          <i class="fas fa-plus"></i> Slips
        </a>
      </li>
      <!------View Slip Icon------>
      <li class="nav-item d-none d-sm-inline-block">
        <a type="button" href="slips.php" class="dropdown-item nav-link">
          <i class="fas fa-wallet"></i> View Slips
        </a>
      </li>
      <!------Create Bill Icon------>
      <li class="nav-item d-none d-sm-inline-block">
        <a type="button" data-toggle="modal" data-target="#modal-bill" class="dropdown-item nav-link">
          <i class="fas fa-plus"></i> Bills
        </a>
      </li>
      <!------Patient Bill Icon------>
      <li class="nav-item d-none d-sm-inline-block">
        <a type="button" href="bill_records.php" class="dropdown-item nav-link">
           <i class="fas fa-wallet"></i> View Bills
        </a>
      </li>
      <!------Patient Record Icon---->
      <li class="nav-item d-none d-sm-inline-block">
        <a type="button" href="patient_record.php" class="dropdown-item nav-link">
          <i class="fas fa-users"></i> Patients
        </a>
      </li>
    </ul> 
      
    <!------Right Navbar Links------>
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a type="button" class="dropdown-item nav-link" data-widget="navbar-search" href="javascript:void(0);" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      <!-- ./Profile Box -->
      <li class="nav-item dropdown user-menu">
        <?php
         if (isset($_SESSION['uuid'])) { 
          echo '<a href="javascript:void(0);" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="dist/img/avatar.png" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline">'.$_SESSION['name'].'</span>';
            }else{
              echo '<a href="profile.php" class="nav-link dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/avatar.png" class="user-image img-circle elevation-2" alt="User Image">
              <span class="d-none d-md-inline">Mobeen Shah</span>';
            } 
        ?>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-primary">
          <?php if (isset($_SESSION['uuid'])) {

            echo '<img src="dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
            <p>'.$_SESSION['name'].'
              <small>Member since '.$_SESSION['savetime'].'</small>
            </p>';
            }
            ?>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
           <?php if (isset($_SESSION['uuid'])) echo '<a href="view_user.php?id='.$_SESSION['uuid'].'" class="btn btn-default btn-flat">Profile</a>'; ?>
            <button type="button" class="btn btn-default btn-flat float-right" data-toggle="modal" data-target="#modal-sm">Logout</button>
          </li>
        </ul>
      </li>
      <!--./Setting Box -->
      <?php if (isset($_SESSION['uuid']) && $_SESSION['role'] == "admin") {  ?>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="javascript:void(0);">
          <i class="fas fa-cog"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Settings</span>
          <div class="dropdown-divider"></div>
          <a href="doctors.php" class="dropdown-item">
            Medeast Doctors <span class="float-right text-muted text-sm"><i class="fas fa-user-md"></i></span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="visiting-doctors.php" class="dropdown-item">
            Visitor Doctors <span class="float-right text-muted text-sm"><i class="fas fa-user-md"></i></span>
          </a>
          <div class="dropdown-divider"></div>  
          <a href="dept.php" class="dropdown-item">
            Departments <span class="float-right text-muted text-sm"><i class="fas fa-building"></i></span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="room.php" class="dropdown-item">
             Rooms <span class="float-right text-muted text-sm"><i class="fas fa-procedures"></i></span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="services.php" class="dropdown-item">
             Services <span class="float-right text-muted text-sm"><i class="fas fa-procedures"></i></span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="users.php" class="dropdown-item">
             Users <span class="float-right text-muted text-sm"><i class="fas fa-users"></i></span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="add_user.php?id=<?php echo $_SESSION['uuid']; ?>" class="dropdown-item">
             Edit Profile <span class="float-right text-muted text-sm"><i class="fas fa-user-edit"></i></span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="change_password.php" class="dropdown-item">
             Change Password <span class="float-right text-muted text-sm"><i class="fas fa-unlock-alt"></i></span>
          </a>
          <div class="dropdown-divider"></div>
          <a type="button" class="dropdown-item" data-toggle="modal" data-target="#modal-sm">
             Logout <span class="float-right text-muted text-sm"><i class="fas fa-sign-out-alt"></i></span>
          </a>                
        </div>
      </li>
      <?php } ?> 
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="javascript:void(0);" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>

<?php include('model_boxes.php'); ?>  
