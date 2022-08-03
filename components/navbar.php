<style>
  .bill-button {
    background: none;
    color: inherit;
    border: none;
    padding: 0;
    font: inherit;
    cursor: pointer;
    outline: inherit;
  }
</style>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="javascript:void(0);" role="button"><i class="fas fa-bars"></i></a>
      </li>

      <!------*********------>
      <!------Home Icon------>
      <!------*********------> 

      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">
          <i class="fas fa-home"></i> Home
        </a>
      </li>

      <!------*****************------>
      <!------Create Slip Icon------>
      <!------*****************------> 

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="javascript:void(0);">
           <i class="fas fa-plus"></i> Slip
        </a>
        <div class="dropdown-menu dropdown-menu-mg dropdown-menu-right">
          <a href="emergency_patient_slip.php" class="dropdown-item">
            <i class="fas fa-user-injured mr-2"></i> Emergency Slip
          </a>
          <div class="dropdown-divider"></div>
          <!-- <a href="indoor_patient_slip.php" class="dropdown-item"> -->
          <a type="button" class="dropdown-item" data-toggle="modal" data-target="#modal-indoor">
            <i class="fas fa-procedures mr-2"></i> Indoor Slip
          </a>
        <div class="dropdown-divider"></div>
          <a href="outdoor_patient_slip.php" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> Outdoor Slip
          </a>
        </div>
       </li>

      <!------*****************------>
      <!------Create Bill Icon------>
      <!------*****************------> 

       <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="javascript:void(0);">
           <i class="fas fa-plus"></i> Bill
        </a>
        <div class="dropdown-menu dropdown-menu-mg dropdown-menu-right">
          <a href="emergency_slip_record.php" class="dropdown-item">
            <i class="fas fa-user-injured mr-2"></i> Emergency Bill
          </a>
          <div class="dropdown-divider"></div>
          <a href="indoor_slip_record.php" class="dropdown-item">
            <i class="fas fa-procedures mr-2"></i> Indoor Bill
          </a>
        </div>
       </li>

      <!------*****************------>
      <!------Indoor Patient Icon------>
      <!------*****************------> 
      <?php if ($_SESSION['type'] == "admin") {  ?>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="patient_record.php" class="nav-link">
          <i class="fas fa-users"></i> Patients
        </a>
      </li>
      <?php } ?>
      <!------*****************------>
      <!------Patient Slip Icon------>
      <!------*****************------> 

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="javascript:void(0);">
           <i class="fas fa-wallet"></i> Slip Records
        </a>
        <div class="dropdown-menu dropdown-menu-mg dropdown-menu-right">
          <a href="emergency_slip_record.php" class="dropdown-item">
            <i class="fas fa-user-injured mr-2"></i> Emergency Records
          </a>
          <div class="dropdown-divider"></div>
          <a href="indoor_slip_record.php" class="dropdown-item">
            <i class="fas fa-procedures mr-2"></i> Indoor Records
          </a>
        <div class="dropdown-divider"></div>
          <a href="outdoor_slip_record.php" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> Outdoor Records
          </a>
        </div>
       </li>

      <!------*****************------>
      <!------Patient Bill Icon------>
      <!------*****************------> 

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="javascript:void(0);">
           <i class="fas fa-wallet"></i> Bill Records
        </a>
        <div class="dropdown-menu dropdown-menu-mg dropdown-menu-right">
          <a href="emergency_bill_record.php" class="dropdown-item">
            <i class="fas fa-user-injured mr-2"></i> Emergency Records
          </a>
          <div class="dropdown-divider"></div>
          <a href="indoor_bill_record.php" class="dropdown-item">
            <i class="fas fa-procedures mr-2"></i> Indoor Records
          </a>
        <div class="dropdown-divider"></div>
          <a href="outdoor_slip_record.php" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> Outdoor Records
          </a>
        </div>
       </li>
     
    </ul> 

    <!------******************------>
    <!------Right Navbar Links------>
    <!------******************------> 

    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="javascript:void(0);" role="button">
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
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="javascript:void(0);">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">2</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">2 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="javascript:void(0);" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="javascript:void(0);" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="javascript:void(0);" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="javascript:void(0);" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <!-- ./Profile Box -->
      <li class="nav-item dropdown user-menu">
        <?php
         if (isset($_SESSION['userid'])) { 
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
          <?php if (isset($_SESSION['userid'])) {

            echo '<img src="dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
            <p>'.$_SESSION['fullname'].'
              <small>Member since '.$_SESSION['savetime'].'</small>
            </p>';
            }
            ?>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
           <?php if (isset($_SESSION['userid'])) echo '<a href="view_user.php?id='.$_SESSION['userid'].'" class="btn btn-default btn-flat">Profile</a>'; ?>
            <button type="button" class="btn btn-default btn-flat float-right" data-toggle="modal" data-target="#modal-sm">Logout</button>
          </li>
        </ul>
      </li>
      <!--./Setting Box -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="javascript:void(0);">
          <i class="fas fa-cog"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Settings</span>
          <div class="dropdown-divider"></div>
          <?php if (isset($_SESSION['userid']) && $_SESSION['type'] == "admin") {  ?>
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
          <a href="users.php" class="dropdown-item">
             Users <span class="float-right text-muted text-sm"><i class="fas fa-users"></i></span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="add_user.php?id=<?php echo $_SESSION['userid']; ?>" class="dropdown-item">
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
          <?php } ?>                 
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="javascript:void(0);" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>

  <!------*******************------>
  <!------Choose Patient Type------>
  <!------*******************------> 

  <div class="modal fade" id="modal-indoor">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Choose Indoor Patient Type</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="indoor_patient_slip.php">
            <div class="modal-body">
                  <select class="form-control select2bs4" name="type" id="typeSelect" style="width: 100%;" required>
                  <?php
                      $indoorType = 'SELECT `TYPE_ALAIS`, `TYPE_NAME` FROM `indoor_type` WHERE `TYPE_STATUS` = "active"';
                      $result = mysqli_query($db, $indoorType) or die (mysqli_error($db));
                          while ($row = mysqli_fetch_array($result)) {
                          $id = $row['TYPE_ALAIS'];  
                          $name = $row['TYPE_NAME'];
                          echo '<option value="'.$id.'">'.$name.'</option>'; 
                      }
                    ?>
                  </select>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Proceed</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      
    <!-- **
    *
    *  Logout Popup Model
    *
    ** -->

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
  