<?php
   // Session Start
   session_start();
   $sid = (isset($_GET['sid']) ? $_GET['sid'] : '');
   $type = (isset($_GET['type']) ? $_GET['type'] : '');
   if (isset($_SESSION['uuid'])) {
     if ($sid) {
       include('backend_components/connection.php');
        
        if ($type == "imrc") {
            // Query to get Emergency Slip Details 
            $slipSql ="SELECT `a`.*, `b`.`ADMIN_USERNAME`	FROM `emergency_slip` AS `a`
            INNER JOIN `admin` AS `b` ON `b`.`ADMIN_ID` = `a`.`STAFF_ID`
            WHERE `SLIP_ID` = ".$sid;
         }
         if ($type == "outdoor") {
            // Query to get Outdoor Slip Details
            $slipSql ="SELECT `a`.*,`b`.`DEPARTMENT_NAME`,`c`.`ADMIN_USERNAME` FROM `outdoor_slip` AS `a`
            INNER JOIN `department` AS `b` ON `a`.`DEPT_ID` = `b`.`DEPARTMENT_ID`
            INNER JOIN `admin` AS `c` ON `c`.`ADMIN_ID` = `a`.`STAFF_ID`
            WHERE `SLIP_ID` = ".$sid;
         }
         if ($type == "indoor") {
            // Query to get Indoor Slip Details 
            $slipSql ="SELECT `a`.*, `b`.`ADMIN_USERNAME`,`c`.`DEPARTMENT_NAME`	FROM `indoor_slip` AS `a`
            INNER JOIN `admin` AS `b` ON `b`.`ADMIN_ID` = `a`.`STAFF_ID`
            INNER JOIN `department` AS `c` ON `c`.`DEPARTMENT_ID` = `a`.`DEPT_ID`
            WHERE `SLIP_ID` = ".$sid;
         }
 
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
?>
        <!-- START RECEIPT -->
            <div class="receipt">
                <img class="watermark" src="dist/img/medeast-logo-icon.png">
                <div class="orderNo">
                    Slip ID# <span><?php echo $dept_row['SLIP_MR_ID']; ?></span> - 
                    <?php 
                        if ($type == "outdoor") {
                            echo '<span>OUTDOOR</span>';
                        } else if ($type == "indoor") {
                            echo '<span>INDOOR</span>';
                        } else if ($type == "imrc") {
                            echo '<span>EMERGENCY</span>';
                        } else {
                            echo '<span>MEDEAST</span>';
                        }
                    ?>
                </div>
                <div class="headerSubTitle">
                <?php echo $dept_row['SLIP_DATE_TIME']; ?>
                </div>
                <div class="headerTitle">
                Medeast Hospital
                </div>
                <?php 
                    if ($type == "outdoor") {
                        echo '<div class="headerSubTitle">OPD Patient</div>';
                    } else if ($type == "indoor") {
                        $newType;
                        if ($dept_row['SLIP_TYPE'] == 'gynae') {
                            $newType = 'Gynae Patient';
                        }else if ($dept_row['SLIP_TYPE'] == 'gensurgery') {
                            $newType = 'General Surgery Patient';
                        }else if ($dept_row['SLIP_TYPE'] == 'genillness') {
                            $newType = 'General Illness Patient';
                        }else if ($dept_row['SLIP_TYPE'] == 'eye') {
                            $newType = 'Eye Patient';
                        }
                        echo '<div class="headerSubTitle">'.$newType.'</div>';
                    } else if ($type == "imrc") {
                        echo '<div class="headerSubTitle">Emergency Patient</div>';
                    } else {
                        echo '<div class="headerSubTitle">MedEast Patient</div>';
                    }
                ?>
                
                <!-- <div id="location">
                
                </div> -->
                <!-- <div id="location">
                AP 29 CH 7553
                </div> -->
                <div id="date">
                C-1 Commercial Office Block, Paragon City, Lahore.
                </div>
                <div id="date">
                0300 4133102, 0320 4707070, 042 37165549
                </div>
                <!-- <hr> -->
                <!-- <svg id="barcode"></svg> -->
                    <table class="table table-bordered" style="font-size: 16px;padding: 0rem !important;margin-bottom: 0px;">
                        <tr>
                            <td class="right-chars"><img style="width:20px;margin-left:15px;" src="dist/img/name-icon.png"> <?php echo $dept_row['SLIP_NAME']; ?></td>
                        </tr>
                        <tr>
                            <td class="right-chars"><img style="width:25px;margin-left:10px;" src="dist/img/phone-icon.png"> <?php echo $dept_row['SLIP_MOBILE']; ?></td>
                        </tr>
                        <?php
                            if ($type != "imrc") {
                        ?>
                        <tr>
                            <td class="right-chars"><img style="width:25px;margin-left:10px;" src="dist/img/department-icon.png"> <?php echo $dept_row['DEPARTMENT_NAME']; ?></td>
                        </tr>
                        <?php
                            }
                        ?>
                        <tr>
                            <td class="right-chars"><img style="width:25px;margin-left:10px;" src="dist/img/doctor-icon.png"> <?php echo $dept_row['DOCTOR_NAME']; ?></td>
                        </tr>
                        <tr>
                            <td class="right-chars"><img style="width:25px;margin-left:10px;" src="dist/img/gender-icon.png"> <?php echo $age." years - ".$gender; ?></td>
                        </tr>
                    </table>
                <!-- Items Purchased -->
                <?php 
                    if ($type == "outdoor") {
                ?>
                <div class="flex">
                    <!-- <div id="qrcode"></div> -->
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
                            <div class="col3">&#8360;-<b><?php echo $dept_row['SLIP_FEE']; ?></b></div>
                        </div>
                        </div>
                        <div class="section">
                        <div class="row">
                            <div class="col1"></div>
                            <div class="col2">Payable: </div>
                            <div class="col3">&#8360;-<b><?php echo $dept_row['SLIP_FEE']; ?></b></div>
                        </div>
                        </div>
                    </div>
                </div>
                <?php 
                    }
                ?>
                <?php
                    if ($type == "indoor") {
                ?>
                <div class="keepItBody">
                   <b>Procedure:</b> <?php echo $dept_row['SLIP_PROCEDURE']; ?>
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
                        staff id# <span><?php echo $dept_row['ADMIN_USERNAME']; ?></span>
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