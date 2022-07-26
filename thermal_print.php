<?php 
  // Session Start
  session_start();
  $sid = (isset($_GET['sid']) ? $_GET['sid'] : '');
  if (isset($_SESSION['userid'])) {
    if ($sid) {
      include('backend_components/connection.php');
        
        $slipSql ="SELECT `a`.*,`b`.`DEPARTMENT_NAME`,`c`.`ADMIN_USERNAME` FROM `outdoor_slip` AS `a`
        INNER JOIN `department` AS `b` ON `a`.`DEPT_ID` = `b`.`DEPARTMENT_ID`
        INNER JOIN `admin` AS `c` ON `c`.`ADMIN_ID` = `a`.`STAFF_ID`
        WHERE `SLIP_ID` = ".$sid;

        $dptsql = mysqli_query($db,$slipSql);
        $dept_row = mysqli_fetch_array($dptsql);

        $date = substr($dept_row['SLIP_DATE_TIME'],0, 24);

        $patSql ="SELECT * FROM `patient` WHERE `PATIENT_MR_ID` = '$dept_row[SLIP_MR_ID]' OR `PATIENT_MOBILE` = '$dept_row[SLIP_MOBILE]'";
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
              <div class="col-md-12">
                <h4 class="page-header text-center" style="font-size: 3vw !important;">
                  <img style="width:10vw;" class="img-responsive" src="dist/img/medeast-logo-icon.png" alt="MedEast Logo"/><b> MEDEAST HOSPITAL</b>
                </h4>
                <div class="col-md-12 text-center" style="font-size: 1.5vw !important;">
                    <p style="margin:0 !important;"><i class="fas fa-map"></i> &nbsp; C-1 Commercial Office Block, Paragon City, Lahore.</p>
                    <p style="margin:0 !important;"><i class="fas fa-phone"></i>&nbsp; 0300 4133102, 0320 4707070, 042 37165549</p>
                    <p style="margin:0 !important;"><i class="fas fa-user-injured"></i>&nbsp;Cash Sales Walking Patient (OPD)</p>

                    <div class="col-md-12 text-left">
                        <div>
                            <p class="text-left" style="margin:0 !important;margin-left:15px !important;"><i class="fas fa-hospital-user"></i>&nbsp;Staff:&nbsp;<?php echo $dept_row['ADMIN_USERNAME']; ?></p>
                        </div>
                        <table class="col-md-12 table">
                        <thead>
                            <tr>
                                <th style="margin:0 !important;padding:0.40rem !important;"><span class="col-md-6">Invoice No#: <?php echo $dept_row['SLIP_MR_ID']; ?></span></th>
                                <th style="margin:0 !important;padding:0.40rem !important;"><span class="col-md-6">Invoice Date: <?php echo $dept_row['SLIP_DATE_TIME']; ?></span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="margin:0 !important;padding:0.25rem !important;"><span class="col-md-6"><b>Patient Name :</b> <?php echo $dept_row['SLIP_NAME']; ?></span></td>
                                <td style="margin:0 !important;padding:0.25rem !important;"><span class="col-md-6"><b>Contact :</b> <?php echo $dept_row['SLIP_MOBILE']; ?></span></td>
                            </tr>
                            <tr>
                                <td style="margin:0 !important;padding:0.25rem !important;"><span class="col-md-6"><b>Gender-Age :</b> <?php echo $gender."-".$age." years"; ?></span></td>
                                <td style="margin:0 !important;padding:0.25rem !important;"><span class="col-md-6"><b>Department :</b> <?php echo $dept_row['DEPARTMENT_NAME']; ?></span></td>
                            </tr>
                            <tr>
                                <td style="margin:0 !important;padding:0.25rem !important;"><span class="col-md-6"><b>Consultant :</b> <?php echo $dept_row['DOCTOR_NAME']; ?></span></td>
                                <td style="margin:0 !important;padding:0.25rem !important;"><span class="col-md-6"><b>Consultant Fee :</b> <?php echo $dept_row['SLIP_FEE']; ?> - PKR</span></td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
              </div>
            <!-- info row -->
          </section>
        </div>
        <script> window.addEventListener("load", window.print());</script>
        <?php
        include('components/footer.php'); 
        echo '</div>';
        include('components/form_script.php');
    }
}else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
}
?>