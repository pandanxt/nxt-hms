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
           <i class="fas fa-wallet"></i> Create Slip
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
           <i class="fas fa-wallet"></i> Create Bill
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

      <li class="nav-item d-none d-sm-inline-block">
        <a href="patient_record.php" class="nav-link">
          <i class="fas fa-users"></i> MedEast Patient
        </a>
      </li>

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
       <!------***********------>
       <!------Doctor Icon------>
       <!------***********------> 

      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="add_doctor.php" class="nav-link">
          <i class="fas fa-user-md"></i> Doctor
        </a>
      </li> -->

      <!------***************------>
      <!------Department Icon------>
      <!------***************------> 

      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="add_dept.php" class="nav-link">
        <i class="fas fa-building"></i> Department
        </a>
      </li> -->

      <!------*********------>
      <!------User Icon------>
      <!------*********------> 

      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="add_user.php" class="nav-link">
          <i class="fas fa-users"></i> Users
        </a>
      </li> -->

      <!------*****************------>
      <!------IMRC Patient Icon------>
      <!------*****************------> 

      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="emergency_patient_slip.php" class="nav-link">
          <i class="fas fa-user-injured"></i> Emergency Patient
        </a>
      </li> -->

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
              <h4 class="modal-title">Choose Patient Type</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="add_bill.php">
            <div class="modal-body">
                  <select class="form-control select2bs4" name="type" id="typeSelect" style="width: 100%;" required>
                  <?php
                      $p_type = 'SELECT `PATIENT_TYPE_NAME`, `PATIENT_TYPE_ALAIS` FROM `patient_type` WHERE `PATIENT_TYPE_STATUS` = "active"';
                      $result = mysqli_query($db, $p_type) or die (mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                          $id = $row['PATIENT_TYPE_ALAIS'];  
                          $name = $row['PATIENT_TYPE_NAME'];
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