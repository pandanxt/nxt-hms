<?php 
  session_start(); 
  if (isset($_SESSION['userid'])) {

    include('backend_components/connection.php');
    include('components/form_header.php');
    include('components/navbar.php'); 
    include('components/sidebar.php');

      // Save Patient Data Query
  if (isset($_POST['add-patient-submit'])) {
    
    // Post Variables
    $name = $_POST['name'];
    $mrid = $_POST['mrid'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $by = $_POST['by'];
    // $saveOn = $_POST['addDate'];  

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
            
        // if ($resultCheck > 0) {
        if($resultCheck == 0) {
            // INSERT INTO `patient`(`PATIENT_MR_ID`, `PATIENT_NAME`, `PATIENT_MOBILE`, `PATIENT_GENDER`, `PATIENT_AGE`, `PATIENT_ADDRESS`, `CREATED_ON`, `CREATED_BY`)
          $patientQuery = "INSERT INTO `patient`
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
              
            if (!mysqli_stmt_prepare($stmt,$patientQuery)) {
              echo "<script>alert('Sqlerror due to DB Query...');</script>";
              exit();
            }else{
                mysqli_stmt_bind_param($stmt,"sssssss", $mrid,$name,$phone,$gender,$age,$address,$by);
                if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('New Patient is created...');</script>";
                echo '<script type="text/javascript">window.location = "patient_record.php";</script>';
                }
            }   
          // echo '<script type="text/javascript">window.location = "emergency.php?action=nameTaken";</script>';
          exit();
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($db);
  }

   if (!empty($_GET['patid'])) {}else {
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Patient</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Patient</li>
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
            <h3 class="card-title"><i class="nav-icon fas fa-hospital-user"></i> MedEast Patient</h3>
            <div class="card-tools">
              <span id='clockDT'></span>
            </div>
          </div>
          <form action="" method="post" enctype="multipart/form-data">
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <!-- /.form-group -->
                <div class="col-md-12" style="display:flex;">
                <div class="form-group col-md-12">
                  <label>Patient MR-ID</label>    
                  <input type="text" name="mrid" class="form-control" id="inputMR1" readonly>
                </div>
                </div>   
                <div class="col-md-12" style="display:flex;">
                <div class="form-group col-md-6">
                  <label>Patient Name</label>
                  <input type="text" name="name" class="form-control" id="inputName1" placeholder="Enter Full Name" required>
                </div>
                <!-- /.form-group -->
                <div class="form-group col-md-6">
                  <label>Mobile No.</label>
                  <input type="tel" name="phone" class="form-control" id="inputPhone" placeholder="Enter Valid Phone No." required>
                </div>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                     <!-- /.form-group -->
                    <div class="col-md-12" style="display:flex;">
                    <div class="form-group col-md-6">
                    <label>Patient Gender</label>
                    <select class="form-control select2bs4" name="gender" style="width: 100%;">
                        <option selected="selected" disabled>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                    </div>
                    <div class="form-group col-md-6">
                    <label>Patient Age</label>
                    <input type="number" name="age" class="form-control" id="inputAge1" placeholder="Enter Age Here" required>
                    </div>
                    </div>   
                    <input type="text" name="by" value="<?php echo $_SESSION['userid'] ; ?>" hidden readonly>
                    <input type="text" name="addDate" id="addDate" hidden/>
                    <script>var addDate = new Date();document.getElementById('addDate').value = addDate;</script>
                    <!-- /.form-group -->
                    <div class="col-md-12" style="display:flex;">
                    <div class="form-group col-md-12">
                        <label>Patient Address</label>
                        <textarea style="height: 38px;" name="address" type="text" class="form-control" id="inputAddress" placeholder="Enter Patient Address" required></textarea>
                    </div>
                    </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer" style="text-align: right;">
            <button type="submit" name="add-patient-submit" class="btn btn-block btn-primary">Submit</button>
          </div>
        </div>
        <!-- /.card -->
        </form>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?php
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