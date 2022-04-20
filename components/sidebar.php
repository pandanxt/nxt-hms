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

            <!------************------>
            <!------Patient Slip------>
            <!------************------> 
            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-hospital-user"></i>
                <p>Patient Slip<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                  <small>
                    <li class="nav-item">
                        <a href="emergency_patient_slip.php" class="nav-link">
                        <i class="nav-icon fas fa-user-injured"></i>
                        <p>Emergency Patient</p>
                        </a>
                    </li>
                  </small>
                  <small>
                    <li class="nav-item">
                        <a href="indoor_patient_slip.php" class="nav-link">
                        <!-- <a type="button" class="nav-link" data-toggle="modal" data-target="#modal-indoor"> -->
                        <i class="nav-icon fas fa-procedures"></i>
                        <p>Indoor Patient</p>  
                        </a>
                    </li>
                  </small>
                  <small>
                    <li class="nav-item">
                        <a href="outdoor_patient_slip.php" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Outdoor Patient</p>
                        </a>
                    </li>
                  </small>
                </ul>
            </li>
            
            <!------************------>
            <!------Patient Bill------>
            <!------************------> 

            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-hospital-user"></i>
                <p>Patient Bill<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                  <small>
                    <li class="nav-item">
                        <a type="button" class="nav-link" data-toggle="modal" data-target="#modal-emergency-bill">
                        <!-- <a href="emergency_bill.php" class="nav-link"> -->
                        <i class="nav-icon fas fa-user-injured"></i>
                        <p>Emergency Bill</p>
                        </a>
                    </li>
                  </small>
                  <small>
                    <li class="nav-item">
                        <a type="button" class="nav-link" data-toggle="modal" data-target="#modal-indoor-bill">
                        <i class="nav-icon fas fa-procedures"></i>
                        <p>Indoor Bill</p>  
                        </a>
                    </li>
                  </small>
                </ul>
            </li>

            <!------**************------>
            <!------Patient Record------>
            <!------**************------> 

            <!-- <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-hospital-user"></i>
                <p>Patient Records<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                  <small>
                    <li class="nav-item">
                        <a href="emergency_patient.php" class="nav-link">
                        <i class="nav-icon fas fa-user-injured"></i>
                        <p>Emergency Patients</p>
                        </a>
                    </li>
                  </small>
                  <small>
                    <li class="nav-item">
                        <a type="button" class="nav-link" data-toggle="modal" data-target="#modal-indoor-patient">
                        <i class="nav-icon fas fa-procedures"></i>
                        <p>Indoor Patients</p>  
                        </a>
                    </li>
                  </small>
                  <small>
                    <li class="nav-item">
                        <a href="outdoor_patient.php" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Outdoor Patients</p>
                        </a>
                    </li>
                  </small>
                </ul>
            </li> -->

            <!------*******************------>
            <!------Patient Slip Record------>
            <!------*******************------> 

            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-hospital-user"></i>
                <p>Slip Records<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                  <small>
                    <li class="nav-item">
                        <a href="emergency_slip_record.php" class="nav-link">
                        <i class="nav-icon fas fa-user-injured"></i>
                        <p>Emergency Slips</p>
                        </a>
                    </li>
                  </small>
                  <small>
                    <li class="nav-item">
                    <a href="indoor_slip_record.php" class="nav-link">
                        <i class="nav-icon fas fa-procedures"></i>
                        <p>Indoor Slips</p>  
                        </a>
                    </li>
                  </small>
                  <small>
                    <li class="nav-item">
                        <a href="outdoor_slip_record.php" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Outdoor Slips</p>
                        </a>
                    </li>
                  </small>
                </ul>
            </li>

            <!------*******************------>
            <!------Patient Bill Record------>
            <!------*******************------> 

            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-hospital-user"></i>
                <p>Bill Records<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                  <small>
                    <li class="nav-item">
                        <a href="emergency_bill_record.php" class="nav-link">
                        <i class="nav-icon fas fa-user-injured"></i>
                        <p>Emergency Bill</p>
                        </a>
                    </li>
                  </small>
                  <small>
                    <li class="nav-item">
                    <a href="indoor_bill_record.php" class="nav-link">
                        <i class="nav-icon fas fa-procedures"></i>
                        <p>Indoor Bill</p>  
                        </a>
                    </li>
                  </small>
                  <small>
                    <li class="nav-item">
                        <a href="outdoor_slip_record.php" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Outdoor Bill</p>
                        </a>
                    </li>
                  </small>
                </ul>
            </li>            

            <!------**************------>
            <!------Patient Record------>
            <!------**************------> 

            <li class="nav-item">
                <a href="patient_record.php" class="nav-link">
                <i class="nav-icon fas fa-user-injured"></i>
                <p>MedEast Patients</p>
                </a>
            </li>

            <!------**************------>
            <!------Doctor Details------>
            <!------**************------> 

            <li class="nav-item">
                <a href="doctors.php" class="nav-link">
                <i class="nav-icon fas fa-user-md"></i>
                <p>Doctor Details</p>
                </a>
            </li>

            <!------******************------>
            <!------Department Details------>
            <!------******************------> 

            <li class="nav-item">
                <a href="dept.php" class="nav-link">
                <i class="nav-icon fas fa-building"></i>
                <p>Departments</p>
                </a>
            </li>
 
            <!------**************------>
            <!------User Details------>
            <!------**************------> 

            <li class="nav-item">
                <a href="users.php" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Users</p>
                </a>
            </li>

            <!------***************------>
            <!------Setting Options------>
            <!------***************------> 

            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>Settings<i class="right fas fa-angle-left"></i></p>
                </a>
                <?php if (isset($_SESSION['userid'])) { ?>
                <ul class="nav nav-treeview">
                  <small>
                    <li class="nav-item">
                        <a href="view_user.php?id=<?php echo $_SESSION['userid']; ?>" class="nav-link">
                        <i class="nav-icon fas fa-user-alt"></i>
                        <p>Profile</p>
                        </a>
                    </li>
                  </small>
                  <small>
                    <li class="nav-item">
                        <a href="add_user.php?id=<?php echo $_SESSION['userid']; ?>" class="nav-link">
                        <i class="nav-icon fas fa-user-edit"></i>
                        <p>Edit Profile</p>
                        </a>
                    </li>
                  </small>
                  <?php } ?>
                  <small>
                    <li class="nav-item">
                        <a href="change_password.php" class="nav-link">
                        <i class="nav-icon fas fa-unlock-alt"></i>
                        <p>Change Password</p>
                        </a>
                    </li>
                  </small>
                  <small>
                    <li class="nav-item">
                        <a href="room.php" class="nav-link">
                        <i class="nav-icon fas fa-procedures"></i>
                        <p>MedEast Room</p>
                        </a>
                    </li>
                  </small>
                  <?php if (isset($_SESSION['userid'])) { ?>
                  <small>
                    <li class="nav-item">
                        <a type="button" class="nav-link" data-toggle="modal" data-target="#modal-sm">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                        </a>
                    </li>
                  </small>
                    <?php } ?>
                </ul>
            </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

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
    
  <!-- **
  *
  *  Indoor Patient Type Popup
  *
  ** -->

  <div class="modal fade" id="modal-indoor">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Indoor Patient Type</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="indoor.php">
        <div class="modal-body">
              <select class="form-control select2bs4" name="type" id="typeSelect" style="width: 100%;" required>
              <?php
                  $p_type = 'SELECT `TYPE_NAME`, `TYPE_ALAIS` FROM `indoor_type` WHERE `TYPE_STATUS` = "active"';
                  $result = mysqli_query($db, $p_type) or die (mysqli_error($db));
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
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

   <!-- **
  *
  *  Indoor Patient Record Popup
  *
  ** -->

  <div class="modal fade" id="modal-indoor-patient">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Indoor Patient Type</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="indoor_patient.php">
        <div class="modal-body">
              <select class="form-control select2bs4" name="type" id="typeSelect" style="width: 100%;" required>
              <option selected="selected" value="all">All Patient</option>
              <?php
                  $p_type = 'SELECT `TYPE_NAME`, `TYPE_ALAIS` FROM `indoor_type` WHERE `TYPE_STATUS` = "active"';
                  $result = mysqli_query($db, $p_type) or die (mysqli_error($db));
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
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

   <!-- **
  *
  *  Indoor Bill Type Popup
  *
  ** -->

  <div class="modal fade" id="modal-indoor-bill">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Indoor Patient Type</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="indoor_bill.php">
        <div class="modal-body">
              <select class="form-control select2bs4" name="type" id="typeSelect" style="width: 100%;" required>
              <?php
                  $p_type = 'SELECT `TYPE_NAME`, `TYPE_ALAIS` FROM `indoor_type` WHERE `TYPE_STATUS` = "active"';
                  $result = mysqli_query($db, $p_type) or die (mysqli_error($db));
                    while ($row = mysqli_fetch_array($result)) {
                      $id = $row['TYPE_ALAIS'];  
                      $name = $row['TYPE_NAME'];
                      echo '<option value="'.$id.'">'.$name.'</option>'; 
                  }
                ?>
              </select>
              <br>
              <input name="mrid" type="text" class="form-control" placeholder="Enter Valid Patient MRID/Phone" style="width: 100%;" required>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Proceed</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  
   <!-- **
  *
  *  Emergency Bill Type Popup
  *
  ** -->

  <div class="modal fade" id="modal-emergency-bill">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Emergency Patient MR #</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="emergency_bill.php">
        <div class="modal-body">
              <!-- <select class="form-control select2bs4" name="type" id="typeSelect" style="width: 100%;" required>
             
              </select> -->
              <input name="mrid" type="text" class="form-control" style="width: 100%;" required>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Proceed</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->