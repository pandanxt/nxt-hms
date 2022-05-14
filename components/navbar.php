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
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
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
        <a class="nav-link" data-toggle="dropdown" href="#">
           <i class="fas fa-plus"></i> Slip
        </a>
        <div class="dropdown-menu dropdown-menu-mg dropdown-menu-right">
          <a href="emergency_patient_slip.php" class="dropdown-item">
            <i class="fas fa-user-injured mr-2"></i> Emergency Slip
          </a>
          <div class="dropdown-divider"></div>
          <a href="indoor_patient_slip.php" class="dropdown-item">
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
        <a class="nav-link" data-toggle="dropdown" href="#">
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
        <a class="nav-link" data-toggle="dropdown" href="#">
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
        <a class="nav-link" data-toggle="dropdown" href="#">
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
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
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
     
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>

  <!------*******************------>
  <!------Choose Patient Type------>
  <!------*******************------> 

  <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Choose Indoor Patient Type</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="indoor_bill_record.php">
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
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      
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
  