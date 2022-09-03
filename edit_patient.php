<?php 
  session_start(); 
  if (isset($_SESSION['uuid'])) {

    include('backend_components/connection.php');
    include('components/form_header.php');
    include('components/navbar.php'); 
    include('components/sidebar.php');

    if (isset($_POST['update-patient-submit'])) {
      
      $pid =  $_POST['pid'];
  		// $mrid =  $_POST['mrid'];
      $name =  $_POST['name'];
      // $mobile =  $_POST['phone'];
      $gender =  $_POST['gender'];
      $age = $_POST['age'];
      $address = $_POST['address'];
      $by = $_POST['by'];
      $saveOn = $_POST['addDate'];

      $sql ="UPDATE `patient` SET `PATIENT_NAME`='$name',`PATIENT_GENDER`='$gender',
      `PATIENT_AGE`='$age',`PATIENT_ADDRESS`='$address',
      `CREATED_ON`='$saveOn',`CREATED_BY`='$by' 
      WHERE `PATIENT_ID` = '$pid'";
			if($qsql = mysqli_query($db,$sql))
			{
				echo "<script>alert('Patient record updated successfully...');window.location = 'patient_record.php';</script>";
			}
			else
			{
				echo mysqli_error($db);
			}	
	}

   if (empty($_GET['patid'])) {}else {

    $patsql="SELECT * FROM `patient`  
    WHERE `patient`.`PATIENT_ID` = '$_GET[patid]'";
    $qsql = mysqli_query($db,$patsql);
    $rsedit = mysqli_fetch_array($qsql);
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
                <div class="col-md-12" style="display:flex;">
                <div class="form-group col-md-12">
                  <label>Patient Name</label>
                  <input type="text" name="name" class="form-control" id="inputName1" value="<?php echo $rsedit['PATIENT_NAME']; ?>" required>
                </div>
                <!-- /.form-group -->
                <!-- <div class="form-group col-md-6">
                  <label>Mobile No.</label>
                  <input type="tel" name="phone" class="form-control" id="inputPhone" value="<?php //echo $rsedit['PATIENT_MOBILE']; ?>" required>
                </div> -->
                </div>
                <!-- /.form-group -->
                <div class="col-md-12" style="display:flex;">
                <div class="form-group col-md-6">
                  <label>Patient Gender</label>
                  <select class="form-control select2bs4" name="gender" style="width: 100%;">
                    <option selected="selected" value="<?php echo $rsedit['PATIENT_GENDER']; ?>"><?php echo $rsedit['PATIENT_GENDER']; ?></option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label>Patient Age</label>
                  <input type="number" name="age" class="form-control" id="inputAge1" value="<?php echo $rsedit['PATIENT_AGE']; ?>" required>
                </div>
                </div>   
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                    <input type="text" name="pid" value="<?php echo $rsedit['PATIENT_ID']; ?>" hidden/>
                    <input type="tel" name="phone" class="form-control" id="inputPhone" value="<?php echo $rsedit['PATIENT_MOBILE']; ?>" hidden>
                    <input type="text" name="mrid" class="form-control" value="<?php echo $rsedit['PATIENT_MR_ID']; ?>" hidden/>
                    <input type="text" name="by" value="<?php echo $_SESSION['uuid'] ; ?>" hidden readonly>
                    <input type="text" name="addDate" id="addDate" hidden/>
                    <script>var addDate = new Date();document.getElementById('addDate').value = addDate;</script>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label>Patient Address</label>
                        <textarea style="height: 120px;" name="address" type="text" class="form-control" id="inputAddress" required><?php echo $rsedit['PATIENT_ADDRESS']; ?></textarea>
                    </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer" style="text-align: right;">
            <button type="submit" name="update-patient-submit" class="btn btn-block btn-primary">Submit</button>
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