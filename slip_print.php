<?php 
 // Session Start
 session_start();
 $sid = (isset($_GET['sid']) ? $_GET['sid'] : '');
 $stype = (isset($_GET['type']) ? $_GET['type'] : '');

if (isset($_SESSION['uuid'])) {  
  // Connection File
  include('backend_components/connection.php');
  // Form Header File
  include('components/form_header.php');
  // Navbar File
  include('components/navbar.php');
  // Sidbar File
  include('components/sidebar.php');

    if($sid) {
       // Query to get Outdoor Slip Details
       if ($stype == 'EMERGENCY') {
        $slipQuery ="SELECT `a`.*,`c`.`USER_NAME`,`d`.`DOCTOR_NAME`, `e`.* FROM `me_slip` AS `a`  
        INNER JOIN `me_user` AS `c` ON `c`.`USER_UUID` = `a`.`STAFF_ID` 
        INNER JOIN `me_doctors` AS `d` ON `d`.`DOCTOR_UUID` = `a`.`SLIP_DOCTOR` 
        INNER JOIN `me_patient` AS `e` ON `e`.`PATIENT_MR_ID` = `a`.`SLIP_MRID` 
        WHERE `a`.`SLIP_UUID` = '$sid'";
    }else {
        $slipQuery ="SELECT `a`.*,`b`.`DEPARTMENT_NAME`,`c`.`USER_NAME`,`d`.`DOCTOR_NAME`, `e`.* FROM `me_slip` AS `a` 
        INNER JOIN `me_department` AS `b` ON `a`.`SLIP_DEPARTMENT` = `b`.`DEPARTMENT_UUID`
        INNER JOIN `me_user` AS `c` ON `c`.`USER_UUID` = `a`.`STAFF_ID`
        INNER JOIN `me_doctors` AS `d` ON `d`.`DOCTOR_UUID` = `a`.`SLIP_DOCTOR`
        INNER JOIN `me_patient` AS `e` ON `e`.`PATIENT_MR_ID` = `a`.`SLIP_MRID`
        WHERE `a`.`SLIP_UUID` = '$sid'";
    }
    
    $sql = mysqli_query($db,$slipQuery);
    $slip_row = mysqli_fetch_array($sql);
    $slipId = $slip_row['SLIP_UUID'];
    $mrId = $slip_row['SLIP_MRID'];
    $name = $slip_row['SLIP_NAME'];
    $phone = $slip_row['SLIP_MOBILE'];
    if ($stype != 'EMERGENCY') {
        $dept = $slip_row['DEPARTMENT_NAME'];
    }
    $doctor = $slip_row['DOCTOR_NAME'];
    $gender = $slip_row['PATIENT_GENDER'];
    $address = $slip_row['PATIENT_ADDRESS'];
    $age = $slip_row['PATIENT_AGE'];
    $date = $slip_row['SLIP_DATE_TIME'];
    $fee = $slip_row['SLIP_FEE'];
    $procedure = $slip_row['SLIP_PROCEDURE'];
    $type = $slip_row['SLIP_TYPE'];
    $subType = $slip_row['SLIP_SUB_TYPE'];
    $staff = $slip_row['USER_NAME'];

?>
<div class="content-wrapper">
    <section class="container invoice">
        <div class="receipt">
            <!-- <img class="watermark" src="dist/img/medeast-logo-icon.png"> -->
            <div class="orderNo">Slip ID# <b><?php echo $mrId; ?></b>
        </div>
        <div class="headerSubTitle"><?php echo $date; ?></div>
        <div class="headerTitle">Medeast Hospital</div>
        <div class="headerSubTitle"><?php echo $type; ?></div>
        <div id="date">C-1 Commercial Office Block, Paragon City, Lahore.</div>
        <div id="date">0300 4133102, 0320 4707070, 042 37165549</div>
        <table class="table table-bordered" style="font-size: 16px;padding: 0rem !important;margin-bottom: 0px;">
            <tr><td class="right-chars"><small>Name: </small> <b><?php echo $name; ?></b></td></tr>
            <tr><td class="right-chars"><small>Phone: </small> <b><?php echo $phone; ?></b></td></tr>
            <?php if ($type != "EMERGENCY") { ?>
            <tr><td class="right-chars"><small>Dept: </small> <b><?php echo $dept; ?></b></td></tr>
            <?php } ?>
            <tr><td class="right-chars"><small>Doctor: </small> <b><?php echo $doctor; ?></b></td></tr>
            <tr><td class="right-chars"><small>Age/Gender: </small> <b><?php echo $age." yrs - ".$gender; ?></b></td></tr>
        </table>
        <?php if ($type == "OUTDOOR") { ?>
        <div class="flex">
            <div class="totals">
                <div class="section">
                    <div class="row">
                        <div class="col1"></div>
                        <div class="col2">Payment Method: </div>
                        <div class="col3"><b>CASH</b></div>
                    </div>
                    <div class="row">
                        <div class="col1"></div>
                        <div class="col2">Consultant Fee: </div>
                        <div class="col3">&#8360;- <b><?php echo $fee; ?></b></div>
                    </div>
                </div>
                <div class="section">
                    <div class="row">
                        <div class="col1"></div>
                        <div class="col2">Payable: </div>
                        <div class="col3">&#8360;- <b><?php echo $fee; ?></b></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if ($type == "INDOOR") { ?>
        <div class="keepItBody">
            <b>Procedure:</b> <?php echo $procedure; ?>
        </div>
        <?php } ?>
        <div class="keepIt">Keep your slip!</div>
        <div class="keepItBody">Computerized generated slip, no need of signature or stamp. Bring this original slip when revisiting MEDEAST Hospital.</div>
        <div style="display:flex;">
            <div class="staffFooter">staff id# <span><?php echo $staff; ?></span></div>
            <div class="brandFooter">powered by: <span>PandaNxt</span></div>
        </div>
        </div>
      </section>
    </div>
    <script> window.addEventListener("load", window.print());</script>
<?php
    }
    echo '</div>';
    include('components/form_script.php');
}else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
} 
?>