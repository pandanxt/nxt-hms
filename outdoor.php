<?php 
  // Session Start
  session_start();
  if (isset($_SESSION['uuid'])) {
  // Connection File
  include('backend_components/connection.php');
  // Form Header File
  include('components/form_header.php');
  // Navbar File
  include('components/navbar.php');
  // Sidebar File
  include('components/sidebar.php');
  // Query to Save Data into DB
  if (isset($_POST['outdoor-patient-submit'])) {
    // Post variable of Form
    $name = $_POST['name'];
    $saveOn = $_POST['addDate'];  
    $mrid = $_POST['mrid'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $doctor = $_POST['doctor'];
    $dept = $_POST['dept'];
    $fee = $_POST['fee'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $by = $_POST['by'];
    // Check from DB if Data exists or not
    $sql = "SELECT * FROM `outdoor_patient` WHERE `PATIENT_NAME` = ? OR `PATIENT_MR_ID` = ? OR `PATIENT_MOBILE` = ?";
    $stmt = mysqli_stmt_init($db);
        
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        echo "<script>alert('Sqlerror due to DB...');</script>";
        exit();
    }else{
        mysqli_stmt_bind_param($stmt,"sss",$name,$mrid,$phone);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
                
          if ($resultCheck > 0) {
              echo "<script>alert('patient name already taken...');</script>";
              exit();
          }else{
              $sql = "INSERT INTO `outdoor_patient`
              (`PATIENT_MR_ID`, 
                `PATIENT_NAME`, 
                `DEPT_ID`, 
                `PATIENT_MOBILE`, 
                `PATIENT_GENDER`, 
                `PATIENT_AGE`, 
                `PATIENT_ADDRESS`, 
                `DOCTOR_ID`, 
                `CONSULTANT_FEE`,
                `PATIENT_DATE_TIME`, 
                `STAFF_ID`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
              mysqli_stmt_execute($stmt);
                    
              if (!mysqli_stmt_prepare($stmt,$sql)) {
                  echo "<script>alert('Sqlerror due to DB Query...');</script>";
                  exit();
              }else{
                  mysqli_stmt_bind_param($stmt,"sssssssssss", $mrid,$name,$dept,$phone,$gender,$age,$address,$doctor,$fee,$saveOn,$by);
                  mysqli_stmt_execute($stmt);
                  echo '<script type="text/javascript">window.location = "outdoor_slip_print.php?pname='.$name.'&on='.$saveOn.'&mrid='.$mrid.'&phone='.$phone.'&gender='.$gender.'&doc='.$doctor.'&age='.$age.'&add='.$address.'&by='.$by.'&dept='.$dept .'&fee='.$fee.'";</script>';
                  exit();
              }			
            }
      }
      mysqli_stmt_close($stmt);
      mysqli_close($db);
    }
 
  if (empty($_GET['id'])) { 
?>
    
  <!-- **
  *
  *  Add Outdoor Patient Form Start Here
  *
  ** -->

    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="card-title p-3"><a href="javascript:history.go(-1)"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;Back</a></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">OPD Patient</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
    
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"><i class="nav-icon fas fa-user"></i> OPD Patient</h3>
            <div class="card-tools">
              <span id='clockDT'></span>
            </div>
          </div>
          <form action="" method="post" enctype="multipart/form-data">
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Patient MR-ID</label>
                  <input type="text" name="mrid" class="form-control" id="inputMR1" readonly>
                </div>
                <div class="form-group">
                  <label>Patient Name</label>
                  <input type="text" name="name" class="form-control" id="inputName1" placeholder="Enter Patient Name Here ..." required>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Mobile No.</label>
                  <input type="tel" name="phone" class="form-control" id="inputPhone" placeholder="Enter Mobile No. without '-' " required>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Patient Gender</label>
                  <select class="form-control select2bs4" name="gender" style="width: 100%;">
                    <option selected="selected" value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Patient Age</label>
                  <input type="number" name="age" class="form-control" id="inputAge1" placeholder="Enter Patient Age Here ..." required>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-md-6">
              <input type="text" name="addDate" id="addDate" hidden/>
              <script>var addDate = new Date();document.getElementById('addDate').value = addDate;</script>
                <!-- /.form-group -->
                <div class="form-group">
                  <label id="doctor">Department</label>
                  <select class="form-control select2bs4" name="dept" style="width: 100%;">
                  <option disabled selected>Select Department</option>
                    <?php
                      $department = 'SELECT `DEPARTMENT_ID`, `DEPARTMENT_NAME` FROM `department` WHERE `DEPARTMENT_STATUS` = "active"';
                      $result = mysqli_query($db, $department) or die (mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                          $id = $row['DEPARTMENT_ID'];  
                          $name = $row['DEPARTMENT_NAME'];
                          echo '<option value="'.$id.'">'.$name.'</option>'; 
                      }
                    ?>
                  </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label id="doctor">Consultant Name</label>
                  <select class="form-control select2bs4" name="doctor" style="width: 100%;">
                  <option disabled selected>Select Consultant</option>
                    <?php
                      $doctor = 'SELECT `DOCTOR_ID`, `DOCTOR_NAME` FROM `doctor` WHERE `DOCTOR_STATUS` = "active"';
                      $result = mysqli_query($db, $doctor) or die (mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                          $id = $row['DOCTOR_ID'];  
                          $name = $row['DOCTOR_NAME'];
                          echo '<option value="'.$id.'">'.$name.'</option>'; 
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Consultant Fee</label>
                  <input type="number" name="fee" class="form-control" id="inputAge1" placeholder="Enter Consultant Fee Here ..." required>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Patient Address</label>
                  <textarea style="height: 120px;" name="address" type="text" class="form-control" id="inputAddress" placeholder="Enter Patient Address Here ..." required></textarea>
                  <input type="text" name="by" value="<?php echo $_SESSION['uuid'] ; ?>" hidden readonly>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer" style="text-align: right;">
            <button type="submit" name="outdoor-patient-submit" class="btn btn-block btn-primary">Submit</button>
          </div>
        </div>
        <!-- /.card -->
        </form>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<!-- **
*
*  Emergency Patient Form Ends Here 
*
** -->

<?php
  }else{
    include('backend_components/update_patient.php');
  }  
  // Footer File
  include('components/footer.php');

  echo '</div>';
  // Form Script File
  include('components/form_script.php');

}else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
}
?>