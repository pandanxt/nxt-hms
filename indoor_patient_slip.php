<?php 
  // Start Session 
  session_start();
  $type = (isset($_GET['type']) ? $_GET['type'] : '');
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
  if (isset($_POST['indoor-patient-slip-submit'])) {
    
    // Post Variables
    $name = $_POST['name'];
    // $saveOn = $_POST['addDate'];  
    $mrid = $_POST['mrid'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $doctor = $_POST['doctor'];
    $dept = $_POST['dept'];
    $procedure = $_POST['procedure'];
    // $type = $_POST['type'];
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
            
          $slipQuery = "INSERT INTO `indoor_slip`(`SLIP_MR_ID`,`SLIP_NAME` ,`SLIP_MOBILE` ,`DEPT_ID`, `DOCTOR_NAME`, `SLIP_PROCEDURE`, `SLIP_TYPE`, `STAFF_ID`,`BILL_STATUS`) VALUES (?,?,?,?,?,?,?,?,?)";
          mysqli_stmt_execute($stmt);
              
            if (!mysqli_stmt_prepare($stmt,$slipQuery)) {
              echo "<script>alert('Sqlerror due to DB Query...');</script>";
              exit();
            }else{
               // Get Data of Patient from DB
               $patientQuery = "SELECT * FROM `patient` WHERE `PATIENT_MR_ID` = '$mrid' OR `PATIENT_MOBILE` = '$phone'";
               $psql = mysqli_query($db,$patientQuery);
               while($prs = mysqli_fetch_array($psql))
               {
                  mysqli_stmt_bind_param($stmt,"sssssssss", $prs['PATIENT_MR_ID'],$name,$prs['PATIENT_MOBILE'],$dept,$doctor,$procedure,$type,$by,$status);
                  if (mysqli_stmt_execute($stmt)) {
                    echo "<script>alert('Patient slip is created but patient data already exists...');</script>";
                      // echo '<script type="text/javascript">window.location = "indoor_slip_print.php?pname='.$prs['PATIENT_NAME'].'&on='.$saveOn.'&type='.$type.'&mrid='.$prs['PATIENT_MR_ID'].'&phone='.$prs['PATIENT_MOBILE'].'&gender='.$prs['PATIENT_GENDER'].'&dept='.$dept.'&doc='.$doctor.'&age='.$prs['PATIENT_AGE'].'&add='.$prs['PATIENT_ADDRESS'].'&pro='.$procedure.'&by='.$by.'";</script>';
                      $printQuery = "SELECT `SLIP_ID` FROM `indoor_slip` ORDER BY `SLIP_ID` DESC LIMIT 1";
                      $printsql = mysqli_query($db, $printQuery) or die (mysqli_error($db));
                      $pResult = mysqli_fetch_array($printsql);

                      if ($pResult > 0) {
                        echo '<script>window.open("print-page.php?type=indoor&sid='.$pResult['SLIP_ID'].'", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=100,,width=1000,height=800");</script>';           
                        echo '<script type="text/javascript">window.location = "indoor_slip_record.php";</script>';
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
            `CREATED_BY`
          ) VALUES (?,?,?,?,?,?,?)";
          mysqli_stmt_execute($stmt);
                
          if (!mysqli_stmt_prepare($stmt,$sql)) {
              echo "<script>alert('Sqlerror due to DB Query...');</script>";
              exit();
          }else{
              mysqli_stmt_bind_param($stmt,"sssssss", $mrid,$name,$phone,$gender,$age,$address,$by);
             
              if (mysqli_stmt_execute($stmt)){
                $slipQuery = "INSERT INTO `indoor_slip`(`SLIP_MR_ID`,`SLIP_NAME` ,`SLIP_MOBILE` , `DEPT_ID`, `DOCTOR_NAME`, `SLIP_PROCEDURE`, `SLIP_TYPE`, `STAFF_ID`,`BILL_STATUS`) VALUES (?,?,?,?,?,?,?,?,?)";
                // mysqli_stmt_execute($stmt);
              
                if (!mysqli_stmt_prepare($stmt,$slipQuery)) {
                  echo "<script>alert('Sqlerror due to DB Query...');</script>";
                  exit();
                }else{
                  mysqli_stmt_bind_param($stmt,"sssssssss", $mrid,$name,$phone,$dept,$doctor,$procedure,$type,$by,$status);
                  if (mysqli_stmt_execute($stmt)) {
                    echo "<script>alert('Patient slip is created and patient data is also stored...');</script>";
                    // echo '<script type="text/javascript">window.location = "indoor_slip_print.php?type='.$type.'&pname='.$name.'&on='.$saveOn.'&mrid='.$mrid.'&phone='.$phone.'&gender='.$gender.'&dept='.$dept.'&doc='.$doctor.'&age='.$age.'&add='.$address.'&pro='.$procedure.'&by='.$by.'";</script>';
                      $printQuery = "SELECT `SLIP_ID` FROM `indoor_slip` ORDER BY `SLIP_ID` DESC LIMIT 1";
                      $printsql = mysqli_query($db, $printQuery) or die (mysqli_error($db));
                      $pResult = mysqli_fetch_array($printsql);

                      if ($pResult > 0) {
                        echo '<script>window.open("print-page.php?type=indoor&sid='.$pResult['SLIP_ID'].'", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=100,,width=1000,height=800");</script>';           
                        echo '<script type="text/javascript">window.location = "indoor_slip_record.php";</script>';
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
  if (empty($_GET['id'])) {
?>
  
    <!-- **
    *
    *  Add Indoor Patient Form Start Here
    *
    ** --> 
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"></section>
    <?php 
      $newType;
      if ($type == 'gynae') {
          $newType = 'Gynae Patient';
      }else if ($type == 'gensurgery') {
          $newType = 'General Surgery Patient';
      }else if ($type == 'genillness') {
          $newType = 'General Illness Patient';
      }else if ($type == 'eye') {
          $newType = 'Eye Patient';
      }
    ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
    
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"><i class="nav-icon fas fa-procedures"></i> <?php echo $newType; ?> Slip</h3>
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
                    <div class="form-group col-md-4">
                        <label>MR-ID #</label>
                        <input type="text" name="mrid" class="form-control" id="inputMR1" readonly>
                    </div>
                    <div class="form-group col-md-8">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" id="inputName1" placeholder="Enter Patient Name Here ..." required>
                    </div>
                </div>

                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                    <div class="form-group col-md-6">
                      <label>Mobile #</label>
                      <input type="tel" name="phone" class="form-control" id="inputPhone" placeholder="Enter Mobile No. without '-' " required>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Gender</label>
                      <select class="form-control select2bs4" name="gender" style="width: 100%;">
                          <option selected="selected" value="male">Male</option>
                          <option value="female">Female</option>
                          <option value="other">Other</option>
                      </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Age</label>
                        <input type="number" step="0.1" name="age" class="form-control" id="inputAge1" placeholder="Enter Age" required>
                    </div>
                </div>

                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                <div class="form-group col-md-6">
                  <label>Department</label>
                  <select class="form-control select2bs4" id="dept" name="dept" style="width: 100%;" onchange="showDoctor(this.value)">
                  <option disabled selected  value="">----- Select Department Name -----</option>
                      <?php
                      $dept = 'SELECT `DEPARTMENT_ID`, `DEPARTMENT_NAME` FROM `department` WHERE `DEPARTMENT_STATUS` = "1"';
                      $result = mysqli_query($db, $dept) or die (mysqli_error($db));
                          while ($row = mysqli_fetch_array($result)) {
                          $id = $row['DEPARTMENT_ID'];  
                          $name = $row['DEPARTMENT_NAME'];
                          echo '<option value="'.$id.'">'.$name.'</option>'; 
                      }
                      ?>
                  </select>
                </div>
                <div class="form-group col-md-6">
                        <label>Consultant/Surgeon</label>
                        <select class="form-control select2bs4" name="doctor" style="width: 100%;" id="doctor">
                        <option disabled selected value="">----- Select Consultant Name -----</option>
                            <?php
                            $doctor = 'SELECT `DOCTOR_ID`, `DOCTOR_NAME` FROM `doctor` WHERE `DOCTOR_STATUS` = "1"';
                            $result = mysqli_query($db, $doctor) or die (mysqli_error($db));
                                while ($row = mysqli_fetch_array($result)) {
                                $id = $row['DOCTOR_ID'];  
                                $name = $row['DOCTOR_NAME'];
                                echo '<option value="'.$name.'">'.$name.'</option>'; 
                            }
                            ?>
                        </select>
                    </div>
                    <script>
                      function showDoctor(str) {
                        if (str=="") {
                          return;
                        }
                        var xmlhttp=new XMLHttpRequest();
                        xmlhttp.onreadystatechange=function() {
                          if (this.readyState==4 && this.status==200) {
                            document.getElementById("doctor").innerHTML=this.responseText;
                          }
                        }
                        xmlhttp.open("GET","getDoctor.php?q="+str,true);
                        xmlhttp.send();
                      }
                    </script>    
                </div>
              
              </div>
              <!-- /.col -->
              <div class="col-md-6">
              <input type="text" name="addDate" id="addDate" hidden/>
              <script>var addDate = new Date();document.getElementById('addDate').value = addDate;</script>
              <input type="text" name="by" value="<?php echo $_SESSION['userid'] ; ?>" hidden readonly>
              
                  <div class="form-group">
                    <label>Procedure/Surgery Type</label>
                    <textarea style="height: 80px;" name="procedure" id="inputProcedure" placeholder="Enter Procedure/Surgery Details Here ..." type="text" class="form-control" required></textarea>
                  </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Address</label>
                  <textarea style="height: 80px;" name="address" type="text" class="form-control" id="inputAddress" placeholder="Enter Patient Address Here ..." required></textarea>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer" style="text-align: right;">
            <button type="submit" name="indoor-patient-slip-submit" class="btn btn-block btn-primary">Submit</button>
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
  include('backend_components/update_patient.php');
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