<?php 
  // Session Start
  session_start();
  $sid = (isset($_GET['sid']) ? $_GET['sid'] : '');
  if (isset($_SESSION['userid'])) {

    if ($sid) {
      # code...
      include('backend_components/connection.php');

        // Query to get Slip Details 
        $slipSql ="SELECT `a`.*,`b`.`DEPARTMENT_NAME`,`c`.`DOCTOR_NAME`, `d`.`ADMIN_USERNAME`	FROM `outdoor_slip` AS `a`
        INNER JOIN `department` AS `b` ON `a`.`DEPT_ID` = `b`.`DEPARTMENT_ID`
        INNER JOIN `doctor` AS `c` ON `c`.`DOCTOR_ID` = `a`.`DOCTOR_ID`
        INNER JOIN `admin` AS `d` ON `d`.`ADMIN_ID` = `a`.`STAFF_ID`
        WHERE `SLIP_ID` = ".$sid;

        $dptsql = mysqli_query($db,$slipSql);
        $dept_row = mysqli_fetch_array($dptsql);

        $date = substr($dept_row['SLIP_DATE_TIME'],0, 24);

        $patSql ="SELECT * FROM `patient` WHERE `PATIENT_MR_ID` = '$dept_row[SLIP_MR_ID]'";
        $patsql = mysqli_query($db,$patSql);
        $patient_row = mysqli_fetch_array($patsql);
      
        $gender = $patient_row['PATIENT_GENDER'];
        $address = $patient_row['PATIENT_ADDRESS'];
        $age = $patient_row['PATIENT_AGE'];

        // Form Header File 
        include('components/form_header.php');
        // Navbar File
        include('components/navbar.php');
        // Sidebar File
        include('components/sidebar.php');

        ?>

        <div class="content-wrapper">
          <!-- Main content -->
          <section class="container invoice">
            <!-- title row -->
            <div class="row">
              <div class="col-md-12">
                <h2 class="page-header">
                  <img src="dist/img/medeast-logo-icon.png" alt="MedEast Logo"/><b> MEDEAST HOSPITAL</b>
                  <small class="float-right" style="font-size:12px;">Slip Date: <?php echo $dept_row['SLIP_DATE_TIME']; ?></small>
                </h2>
                <div class="float-right" style="margin-top: -125px;">
                <div style="display:flex;">
                <div style="margin:5px 10px;font-size:30px;"><i class="fas fa-map"></i></div>
                <div style="font-size:15px;">C-1 Commercial Office Block, <br> Paragon City, Lahore.</div>
                </div>
                <div style="display:flex;">
                <div style="margin:15px 10px;font-size:30px;"><i class="fas fa-phone"></i></div> 
                <div style="font-size:15px;"> 0300 4133102 <br> 0320 4707070 <br> 042 37165549</div>
                </div>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
            <!-- /.col -->
            <div class="col-sm-6 invoice-col">
            <hr style="margin-top:5px;"/>
                <h4><b>MR_ID# </b><?php echo $dept_row['SLIP_MR_ID']; ?></h4><br>
                <h4><b>Patient Name :</b> <?php echo $dept_row['SLIP_NAME']; ?></h4><br>
                <h4><b>Contact :</b> <?php echo $dept_row['SLIP_MOBILE']; ?></h4><br>
                <h4><b>Consultant :</b> <?php echo $dept_row['DOCTOR_NAME']; ?></h4><br>
                <h4><b>Consultant Fee :</b> <?php echo $dept_row['SLIP_FEE']; ?></h4><br>
                <h4><b>Staff :</b> <?php echo $dept_row['ADMIN_USERNAME']; ?></h4><br>
              </div>
              <!-- /.col -->
              <div class="col-sm-6 invoice-col">
              <hr style="margin-top:5px;"/>
                <h4><b>Date/Time :</b> <?php echo $date; ?></h4><br>
                <h4><b>Department :</b> <?php echo $dept_row['DEPARTMENT_NAME']; ?></h4><br>
                <h4><b>Age :</b> <?php echo $age; ?></h4><br>
                <h4><b>Gender :</b> <?php echo $gender; ?></h4><br>
                <h4><b>Address :</b> <?php echo $address; ?></h4><br>
                <!-- <h4><b>Time :</b> <?php //echo $saveOn; ?></h4><br> -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </section>
          <!-- /.content -->
        </div>
        <!-- ./wrapper -->
        <!-- Page specific script -->
        <script> window.addEventListener("load", window.print());</script>
        <!-- Main Footer -->
        <?php
        // Footer File
        include('components/footer.php'); 
        echo '</div>';
        // Form Script File
        include('components/form_script.php');

    }else {
      #code...
        // Get Variables from URL
        $pname = (isset($_GET['pname']) ? $_GET['pname'] : '');
        $saveOn = (isset($_GET['on']) ? $_GET['on'] : '');
        $mrid = (isset($_GET['mrid']) ? $_GET['mrid'] : '');
        $phone = (isset($_GET['phone']) ? $_GET['phone'] : '');
        $gender = (isset($_GET['gender']) ? $_GET['gender'] : '');
        $doctor = (isset($_GET['doc']) ? $_GET['doc'] : '');
        $age = (isset($_GET['age']) ? $_GET['age'] : '');
        $fee = (isset($_GET['fee']) ? $_GET['fee'] : '');
        $department = (isset($_GET['dept']) ? $_GET['dept'] : '');
        $address = (isset($_GET['add']) ? $_GET['add'] : '');
        $by = (isset($_GET['by']) ? $_GET['by'] : '');

        $date = substr($saveOn,0, 24);

        // Connection File
        include('backend_components/connection.php');

        // Query to get Department Details 
        $deptSql ="SELECT `DEPARTMENT_NAME` FROM `department` WHERE `DEPARTMENT_ID` =".$department;
        $dptsql = mysqli_query($db,$deptSql);
        $dept_row = mysqli_fetch_array($dptsql);
        // Query to get Doctor Details
        $docSql ="SELECT `DOCTOR_NAME` FROM `doctor` WHERE `DOCTOR_ID` =".$doctor;
        $dsql = mysqli_query($db,$docSql);
        $doctor_row = mysqli_fetch_array($dsql);
        // Query to get Admin Details
        $adminSql ="SELECT `ADMIN_USERNAME` FROM `admin` WHERE `ADMIN_ID` =".$by;
        $asql = mysqli_query($db,$adminSql);
        $admin_row = mysqli_fetch_array($asql);

        // Form Header File 
        include('components/form_header.php');
        // Navbar File
        include('components/navbar.php');
        // Sidebar File
        include('components/sidebar.php');
      ?>

      <div class="content-wrapper">
        <!-- Main content -->
        <section class="container invoice">
          <!-- title row -->
          <div class="row">
            <div class="col-md-12">
              <h2 class="page-header">
                <img src="dist/img/medeast-logo-icon.png" alt="MedEast Logo"/><b> MEDEAST HOSPITAL</b>
                <small class="float-right" style="font-size:12px;">Slip Date: <?php echo $saveOn; ?></small>
              </h2>
              <div class="float-right" style="margin-top: -125px;">
              <div style="display:flex;">
              <div style="margin:5px 10px;font-size:30px;"><i class="fas fa-map"></i></div>
              <div style="font-size:15px;">C-1 Commercial Office Block, <br> Paragon City, Lahore.</div>
              </div>
              <div style="display:flex;">
              <div style="margin:15px 10px;font-size:30px;"><i class="fas fa-phone"></i></div> 
              <div style="font-size:15px;"> 0300 4133102 <br> 0320 4707070 <br> 042 37165549</div>
              </div>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
          <!-- /.col -->
          <div class="col-sm-6 invoice-col">
          <hr style="margin-top:5px;"/>
              <h4><b>MR_ID# </b><?php echo $mrid; ?></h4><br>
              <h4><b>Patient Name :</b> <?php echo $pname; ?></h4><br>
              <h4><b>Contact :</b> <?php echo $phone; ?></h4><br>
              <h4><b>Department :</b> <?php echo $dept_row['DEPARTMENT_NAME']; ?></h4><br>
              <h4><b>Consultant :</b> <?php echo $doctor_row['DOCTOR_NAME']; ?></h4><br>
              <h4><b>Consultant Fee :</b> <?php echo $fee; ?></h4><br>
            </div>
            <!-- /.col -->
            <div class="col-sm-6 invoice-col">
            <hr style="margin-top:5px;"/>
              <h4><b>Age :</b> <?php echo $age; ?></h4><br>
              <h4><b>Gender :</b> <?php echo $gender; ?></h4><br>
              <h4><b>Address :</b> <?php echo $address; ?></h4><br>
              <h4><b>Date/Time :</b> <?php echo $date; ?></h4><br>
              <h4><b>Staff :</b> <?php echo $admin_row['ADMIN_USERNAME'];; ?></h4><br>
              <!-- <h4><b>Time :</b> <?php //echo $saveOn; ?></h4><br> -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </section>
        <!-- /.content -->
      </div>
      <!-- ./wrapper -->
      <!-- Page specific script -->
      <script> window.addEventListener("load", window.print());</script>
      <!-- Main Footer -->
      <?php
      // Footer File
      include('components/footer.php'); 
      echo '</div>';
      // Form Script File
      include('components/form_script.php');
  }

}else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
}
?>