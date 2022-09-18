<?php
   // Session Start
   session_start();
   $sid = (isset($_GET['sid']) ? $_GET['sid'] : '');
   $stype = (isset($_GET['type']) ? $_GET['type'] : '');
   if (isset($_SESSION['uuid'])) {
     if ($sid) {
       include('backend_components/connection.php');
        // Query to get Outdoor Slip Details
       if ($stype == 'EMERGENCY_SLIP') {
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
        if ($stype != 'EMERGENCY_SLIP') {
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
    
        include('components/form_header.php');
?>
        <!-- START RECEIPT -->
            <div class="receipt">
                <img class="watermark" src="dist/img/medeast-logo-icon.png">
                <div class="orderNo">
                    Slip ID# <span><?php echo $mrId; ?></span>
                </div>
                <div class="headerSubTitle">
                <?php echo $date; ?>
                </div>
                <div class="headerTitle">
                Medeast Hospital
                </div>
                <?php echo '<div class="headerSubTitle">'.$type.'</div>'; ?>
                <div id="date">
                C-1 Commercial Office Block, Paragon City, Lahore.
                </div>
                <div id="date">
                0300 4133102, 0320 4707070, 042 37165549
                </div>
                <table class="table table-bordered" style="font-size: 16px;padding: 0rem !important;margin-bottom: 0px;">
                    <tr>
                        <td class="right-chars"><img style="width:20px;margin-left:15px;" src="dist/img/name-icon.png"> <?php echo $name; ?></td>
                    </tr>
                    <tr>
                        <td class="right-chars"><img style="width:25px;margin-left:10px;" src="dist/img/phone-icon.png"> <?php echo $phone; ?></td>
                    </tr>
                    <?php
                        if ($type != "EMERGENCY_SLIP") {
                    ?>
                    <tr>
                        <td class="right-chars"><img style="width:25px;margin-left:10px;" src="dist/img/department-icon.png"> <?php echo $dept; ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                    <tr>
                        <td class="right-chars"><img style="width:25px;margin-left:10px;" src="dist/img/doctor-icon.png"> 
                        <?php echo $doctor; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="right-chars"><img style="width:25px;margin-left:10px;" src="dist/img/gender-icon.png"> <?php echo $age." years - ".$gender; ?></td>
                    </tr>
                </table>
                <?php 
                    if ($type == "OUTDOOR_SLIP") {
                ?>
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
                            <div class="col3">&#8360;-<b><?php echo $fee; ?></b></div>
                        </div>
                        </div>
                        <div class="section">
                        <div class="row">
                            <div class="col1"></div>
                            <div class="col2">Payable: </div>
                            <div class="col3">&#8360;-<b><?php echo $fee; ?></b></div>
                        </div>
                        </div>
                    </div>
                </div>
                <?php 
                    }
                ?>
                <?php
                    if ($type == "INDOOR_SLIP") {
                ?>
                <div class="keepItBody">
                   <b>Procedure:</b> <?php echo $procedure; ?>
                </div>
                <?php
                    }
                ?>
                <div class="keepIt">
                Keep your slip!
                </div>
                <div class="keepItBody">
                Computerized generated slip, no need of signature or stamp. Bring this original slip when revisiting MEDEAST Hospital.
                </div>
                <div style="display:flex;">
                    <div class="staffFooter">
                        staff id# <span><?php echo $staff; ?></span>
                    </div>
                    <div class="brandFooter">
                        powered by: <span>PandaNxt</span>
                    </div>
                </div>
               
            </div>
 <script> 
    setTimeout(() => {
        window.addEventListener("load", window.print());       
    }, 1000);
 </script>
 <?php
 echo '</div>';
 include('components/form_script.php');
 }
}else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
} 
?>