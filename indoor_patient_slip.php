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
  if (isset($_POST['indoor-patient-slip-submit'])) {
    
    // Post Variables
    $name = $_POST['name'];
    $saveOn = $_POST['addDate'];  
    $mrid = $_POST['mrid'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $doctor = $_POST['doctor'];
    // $cnic = $_POST['cnic'];
    $procedure = $_POST['procedure'];
    $type = $_POST['type'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $by = $_POST['by'];

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
            
          $slipQuery = "INSERT INTO `indoor_slip`(`SLIP_MR_ID`,`SLIP_NAME` ,`SLIP_MOBILE` , `DOCTOR_ID`, `SLIP_PROCEDURE`, `SLIP_TYPE`, `SLIP_DATE_TIME`, `STAFF_ID`) VALUES (?,?,?,?,?,?,?,?)";
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
                  mysqli_stmt_bind_param($stmt,"ssssssss", $prs['PATIENT_MR_ID'],$name,$prs['PATIENT_MOBILE'],$doctor,$procedure,$type,$saveOn,$by);
                  if (mysqli_stmt_execute($stmt)) {
                    echo "<script>alert('Patient slip is created but patient data already exists...');</script>";
                      // echo "<script>alert('Data fetched from DB...pname='".$prs['PATIENT_NAME']."'&on='".$saveOn."'&mrid='".$prs['PATIENT_MR_ID']."'&phone='".$prs['PATIENT_MOBILE']."'&gender='".$prs['PATIENT_GENDER']."'&doc='".$doctor."'&age='".$prs['PATIENT_AGE']."'&add='".$prs['PATIENT_ADDRESS']."'&by='".$by."');</script>";
                      echo '<script type="text/javascript">window.location = "indoor_slip_print.php?pname='.$prs['PATIENT_NAME'].'&on='.$saveOn.'&type='.$type.'&mrid='.$prs['PATIENT_MR_ID'].'&phone='.$prs['PATIENT_MOBILE'].'&gender='.$prs['PATIENT_GENDER'].'&doc='.$doctor.'&age='.$prs['PATIENT_AGE'].'&add='.$prs['PATIENT_ADDRESS'].'&pro='.$procedure.'&by='.$by.'";</script>';
                  }
                } 
            }   
          // echo '<script type="text/javascript">window.location = "emergency.php?action=nameTaken";</script>';
          exit();
        }else{

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
                $slipQuery = "INSERT INTO `indoor_slip`(`SLIP_MR_ID`,`SLIP_NAME` ,`SLIP_MOBILE` , `DOCTOR_ID`, `SLIP_PROCEDURE`, `SLIP_TYPE`, `SLIP_DATE_TIME`, `STAFF_ID`) VALUES (?,?,?,?,?,?,?,?)";
                mysqli_stmt_execute($stmt);
              
                if (!mysqli_stmt_prepare($stmt,$slipQuery)) {
                  echo "<script>alert('Sqlerror due to DB Query...');</script>";
                  exit();
                }else{
                  mysqli_stmt_bind_param($stmt,"ssssssss", $mrid,$name,$phone,$doctor,$procedure,$type,$saveOn,$by);
                  if (mysqli_stmt_execute($stmt)) {
                    echo "<script>alert('Patient slip is created and patient data is also stored...');</script>";
                    echo '<script type="text/javascript">window.location = "indoor_slip_print.php?type='.$type.'&pname='.$name.'&on='.$saveOn.'&mrid='.$mrid.'&phone='.$phone.'&gender='.$gender.'&doc='.$doctor.'&age='.$age.'&add='.$address.'&pro='.$procedure.'&by='.$by.'";</script>';
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="card-title p-3"><a href="javascript:history.go(-1)"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;Back</a></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Indoor Slip</li>
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
            <h3 class="card-title"><i class="nav-icon fas fa-procedures"></i> Indoor Patient Slip</h3>
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
                        <input type="number" name="age" class="form-control" id="inputAge1" placeholder="Enter Age" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label id="doctor">Consultant Name</label>
                        <select class="form-control select2bs4" name="doctor" style="width: 100%;">
                        <option disabled selected>Select Consultant Name</option>
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
                </div>

                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                    <div class="form-group col-md-6">
                    <label>Mobile #</label>
                  <input type="tel" name="phone" class="form-control" id="inputPhone" placeholder="Enter Mobile No. without '-' " required>
                    </div>
                    <!-- <div class="form-group col-md-6">
                      <label>CNIC #</label>
                      <input type="number" name="cnic" class="form-control" id="inputPhone" placeholder="Enter CNIC No. without '-' ">
                    </div> -->
                    <div class="form-group col-md-6">
                  <label>Indoor Patient Type</label>
                    <select class="form-control select2bs4" name="type" style="width: 100%;">
                    <option disabled selected>Select Indoor Type</option>
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
                </div>
              
              </div>
              <!-- /.col -->
              <div class="col-md-6">
              <input type="text" name="addDate" id="addDate" hidden/>
              <script>var addDate = new Date();document.getElementById('addDate').value = addDate;</script>
                <div class="form-group">
                  <label>Procedure</label>
                  <input type="text" class="form-control" name="procedure" id="inputProcedure" placeholder="Enter Procedure Here ..." />
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Address</label>
                  <textarea style="height: 120px;" name="address" type="text" class="form-control" id="inputAddress" placeholder="Enter Patient Address Here ..." required></textarea>
                  <input type="text" name="by" value="<?php echo $_SESSION['userid'] ; ?>" hidden readonly>
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