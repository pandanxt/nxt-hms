<?php 
  // Start Session 
  session_start();
  if (isset($_SESSION['userid'])) {
  // Connection File
  include('backend_components/connection.php');
  // Form Header File
  include('components/form_header.php');
  // Navbar File
  include('components/navbar.php');
  // Sidebar File
  include('components/sidebar.php');

  // Save Patient Data Query
  if (isset($_POST['imrc-patient-submit'])) {
    
    // Post Variables
    $name = $_POST['name'];
    $saveOn = $_POST['addDate'];  
    $mrid = $_POST['mrid'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $doctor = $_POST['doctor'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $by = $_POST['by'];
    $status = "pending";

    // Check Data from DB
    $sql = "SELECT * FROM `patient` WHERE `PATIENT_MR_ID` = ? OR `PATIENT_MOBILE` = ?";
    $stmt = mysqli_stmt_init($db);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        echo "<script>alert('Sqlerror due to DB...');</script>";
        exit();
    }else{
        mysqli_stmt_bind_param($stmt,"ss",$mrid,$phone);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
            
        if ($resultCheck > 0) {
          $slipQuery = "INSERT INTO `emergency_slip`(`SLIP_MR_ID`,`SLIP_NAME` ,`SLIP_MOBILE` , `DOCTOR_NAME`, `SLIP_DATE_TIME`, `STAFF_ID`, `BILL_STATUS`) VALUES (?,?,?,?,?,?,?)";
          mysqli_stmt_execute($stmt);
              
            if (!mysqli_stmt_prepare($stmt,$slipQuery)) {
              echo "<script>alert('Sqlerror due to DB Query...');</script>";
              exit();
            }else{
              $patientQuery = "SELECT * FROM `patient` WHERE `PATIENT_MR_ID` = '$mrid' OR `PATIENT_MOBILE` = '$phone'";
              $psql = mysqli_query($db,$patientQuery);
              while($prs = mysqli_fetch_array($psql))
              {
                  mysqli_stmt_bind_param($stmt,"sssssss", $prs['PATIENT_MR_ID'],$name,$prs['PATIENT_MOBILE'],$doctor,$saveOn,$by,$status);
                  if (mysqli_stmt_execute($stmt)) {
                    echo "<script>alert('Patient slip is created but patient data already exists...');</script>";
                  
                    $printQuery = "SELECT `SLIP_ID` FROM `emergency_slip` ORDER BY `SLIP_ID` DESC LIMIT 1";
                    $printsql = mysqli_query($db, $printQuery) or die (mysqli_error($db));
                    $pResult = mysqli_fetch_array($printsql);

                    if ($pResult > 0) {
                      echo '<script type="text/javascript">window.location = "emergency_slip_print.php?sid='.$pResult['SLIP_ID'].'";</script>';
                    }
                  }
              } 
            }   
          exit();
        }else if($resultCheck == 0){

            $sql = "INSERT INTO `patient`
          (
            `PATIENT_MR_ID`, 
            `PATIENT_NAME`, 
            `PATIENT_MOBILE`, 
            `PATIENT_GENDER`, 
            `PATIENT_AGE`, 
            `PATIENT_ADDRESS`, 
            `CREATED_ON`, 
            `CREATED_BY`
          ) VALUES (?,?,?,?,?,?,?,?)";
          mysqli_stmt_execute($stmt);
                
          if (!mysqli_stmt_prepare($stmt,$sql)) {
              echo "<script>alert('Sqlerror due to DB Query...');</script>";
              exit();
          }else{
              mysqli_stmt_bind_param($stmt,"ssssssss", $mrid,$name,$phone,$gender,$age,$address,$saveOn,$by);
             
              if (mysqli_stmt_execute($stmt)){
                $slipQuery = "INSERT INTO `emergency_slip`(`SLIP_MR_ID`,`SLIP_NAME`,`SLIP_MOBILE`, `DOCTOR_NAME`, `SLIP_DATE_TIME`, `STAFF_ID`,`BILL_STATUS`) VALUES (?,?,?,?,?,?,?)";
                // mysqli_stmt_execute($stmt);
              
                if (!mysqli_stmt_prepare($stmt,$slipQuery)) {
                  echo "<script>alert('Sqlerror due to DB Query...');</script>";
                  exit();
                }else{
                  mysqli_stmt_bind_param($stmt,"sssssss", $mrid,$name,$phone,$doctor,$saveOn,$by,$status);
                  if (mysqli_stmt_execute($stmt)) {
                     
                    $printQuery = "SELECT `SLIP_ID` FROM `emergency_slip` ORDER BY `SLIP_ID` DESC LIMIT 1";
                    $printsql = mysqli_query($db, $printQuery) or die (mysqli_error($db));
                    $pResult = mysqli_fetch_array($printsql);

                    if ($pResult > 0) {
                      echo '<script type="text/javascript">window.location = "emergency_slip_print.php?sid='.$pResult['SLIP_ID'].'";</script>';
                    }
                  } 
                }   
              }
            exit();
          }			
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($db);
  }

  // Check if ID is empty
  if (empty($_GET['epsid'])) {
?>
  
  <!-- **
  *
  *  Add Emergency Patient Form Start Here
  *
  ** -->

  <div class="content-wrapper">
  <section class="content-header"></section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
  
      <!-- SELECT2 EXAMPLE -->
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title"><i class="nav-icon fas fa-user-injured"></i> Emergency Patient</h3>
          <div class="card-tools">
            <span id='clockDT'></span>
          </div>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              
              <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                <div class="form-group col-md-6">
                  <label>Patient MR-ID</label>
                  <input type="text" name="mrid" class="form-control" id="inputMR1" readonly>
                </div>
                <div class="form-group col-md-6">
                  <label>Patient Name</label>
                  <input type="text" name="name" class="form-control" id="inputName1" placeholder="Enter Patient Name Here ..." required>
                </div>
              </div>

              <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                <div class="form-group col-md-6">
                  <label>Mobile No#</label>
                  <input type="tel" name="phone" class="form-control" id="inputPhone" placeholder="Enter Mobile No. without '-' " required>
                </div>
                <!-- /.form-group -->
                <div class="form-group col-md-6">
                  <label id="doctor">Medical Officer (MO)</label>
                  <select class="form-control select2bs4" name="doctor" style="width: 100%;">
                  <option disabled selected>Select Doctor Name</option>
                    <?php
                      $doctor = 'SELECT `DOCTOR_ID`, `DOCTOR_NAME` FROM `doctor` WHERE `DOCTOR_STATUS` = "active" AND `DEPARTMENT_ID` = 21';
                      $result = mysqli_query($db, $doctor) or die (mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                          $id = $row['DOCTOR_ID'];  
                          $name = $row['DOCTOR_NAME'];
                          echo '<option value="'.$name.'">'.$name.'</option>'; 
                      }
                    ?>
                  </select>
                </div>
              </div>
              <!-- /.form-group -->
            </div>
              
            <!-- /.col -->
            <div class="col-md-6">
            <input type="text" name="addDate" id="addDate" hidden/>
            <script>var addDate = new Date();document.getElementById('addDate').value = addDate;</script>
              
            <div class="col-md-12" style="display:flex;margin:0;padding:0;">
              <div class="form-group col-md-6">
                <label>Patient Age</label>
                <input type="number" name="age" step="0.1" class="form-control" id="inputAge1" placeholder="Enter Patient Age Here ..." required>
              </div>
              <!-- /.form-group -->
              <div class="form-group col-md-6">
                <label>Patient Gender</label>
                <select class="form-control select2bs4" name="gender" style="width: 100%;">
                  <option selected="selected" value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                </select>
              </div>
            </div>
              
              <!-- /.form-group -->
              <div class="form-group">
                <label>Patient Address</label>
                <textarea style="height:40px;" name="address" type="text" class="form-control" id="inputAddress" placeholder="Enter Patient Address Here ..." required></textarea>
                <input type="text" name="by" value="<?php echo $_SESSION['userid'] ; ?>" hidden readonly>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer" style="text-align: right;">
          <button type="submit" name="imrc-patient-submit" class="btn btn-block btn-primary">Submit</button>
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
  // Update Emergency Patient
  // include('backend_components/update_patient.php');
  $patsql="SELECT * FROM `emergency_slip` WHERE `SLIP_ID` = '$_GET[epsid]'";
    
    $qsql = mysqli_query($db,$patsql);
    $rsedit = mysqli_fetch_array($qsql);

?>

 <!-- **
  *
  *  Add Emergency Patient Form Start Here
  *
  ** -->

  <div class="content-wrapper">
  <section class="content-header"></section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
  
      <!-- SELECT2 EXAMPLE -->
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title"><i class="nav-icon fas fa-user-injured"></i> Emergency Patient</h3>
          <div class="card-tools">
            <span id='clockDT'></span>
          </div>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              
              <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                <div class="form-group col-md-6">
                  <label>Patient MR-ID</label>
                  <input type="text" name="mrid" class="form-control" value="<?php echo $rsedit['SLIP_MR_ID']; ?>" readonly>
                </div>
                <div class="form-group col-md-6">
                  <label>Patient Name</label>
                  <input type="text" name="name" class="form-control" id="inputName1" value="<?php echo $rsedit['SLIP_NAME']; ?>" required>
                </div>
              </div>

              <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                <div class="form-group col-md-6">
                  <label>Mobile No#</label>
                  <input type="tel" name="phone" class="form-control" id="inputPhone" value="<?php echo $rsedit['SLIP_MOBILE']; ?>" required>
                </div>
                <!-- /.form-group -->
                <div class="form-group col-md-6">
                  <label id="doctor">Medical Officer (MO)</label>
                  <select class="form-control select2bs4" name="doctor" style="width: 100%;">
                  <option disabled selected>Select Doctor Name</option>
                    <?php
                      $doctor = 'SELECT `DOCTOR_ID`, `DOCTOR_NAME` FROM `doctor` WHERE `DOCTOR_STATUS` = "active"';
                      $result = mysqli_query($db, $doctor) or die (mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                          $id = $row['DOCTOR_ID'];  
                          $name = $row['DOCTOR_NAME'];
                          echo '<option value="'.$name.'">'.$name.'</option>'; 
                      }
                    ?>
                  </select>
                </div>
              </div>
              <!-- /.form-group -->
            </div>
              
            <!-- /.col -->
            <div class="col-md-6">
            <input type="text" name="addDate" id="addDate" hidden/>
            <script>var addDate = new Date();document.getElementById('addDate').value = addDate;</script>
              
            <div class="col-md-12" style="display:flex;margin:0;padding:0;">
              <div class="form-group col-md-6">
                <label>Patient Age</label>
                <input type="number" name="age" class="form-control" id="inputAge1" value="<?php //echo $rsedit['SLIP_MR_ID']; ?>" required>
              </div>
              <!-- /.form-group -->
              <div class="form-group col-md-6">
                <label>Patient Gender</label>
                <select class="form-control select2bs4" name="gender" style="width: 100%;">
                  <option selected="selected" value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                </select>
              </div>
            </div>
              
              <!-- /.form-group -->
              <div class="form-group">
                <label>Patient Address</label>
                <textarea style="height:40px;" name="address" type="text" class="form-control" id="inputAddress" value="<?php //echo $rsedit['SLIP_MR_ID']; ?>" required></textarea>
                <input type="text" name="by" value="<?php echo $_SESSION['userid'] ; ?>" hidden readonly>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer" style="text-align: right;">
          <button type="submit" name="imrc-patient-submit" class="btn btn-block btn-primary">Submit</button>
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
}

// Footer File
include('components/footer.php');

echo '</div>';

// Form Script Files
include('components/form_script.php');

}else{
echo '<script type="text/javascript">window.location = "login.php";</script>';
}
?>