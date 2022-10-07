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
       if ($stype == 'FOLLOWUP_SLIP') {
            $slipQuery ="SELECT `a`.*,`b`.`SLIP_MRID`,`b`.`SLIP_NAME`,`b`.`SLIP_MOBILE`,`b`.`SLIP_DEPARTMENT`,`b`.`SLIP_DOCTOR`,`b`.`SLIP_TYPE`,`b`.`SLIP_SUB_TYPE`,`c`.`USER_NAME`,`d`.`DOCTOR_NAME`, `e`.* , `f`.`DEPARTMENT_NAME` FROM `me_followup_slip` AS `a`  
            INNER JOIN `me_slip` AS `b` ON `b`.`SLIP_UUID` = `a`.`SLIP_REFERENCE_UUID`
            INNER JOIN `me_user` AS `c` ON `c`.`USER_UUID` = `a`.`STAFF_ID` 
            INNER JOIN `me_doctors` AS `d` ON `d`.`DOCTOR_UUID` = `b`.`SLIP_DOCTOR`
            INNER JOIN `me_department` AS `f` ON `f`.`DEPARTMENT_UUID` = `b`.`SLIP_DEPARTMENT` 
            INNER JOIN `me_patient` AS `e` ON `e`.`PATIENT_MR_ID` = `b`.`SLIP_MRID` 
            WHERE `a`.`SLIP_UUID` = '$sid'";
        }else if($stype == 'SERVICE_SLIP') {
            $slipQuery ="SELECT `a`.*,`b`.`SLIP_MRID`,`b`.`SLIP_NAME`,`b`.`SLIP_MOBILE`,`b`.`SLIP_DEPARTMENT`,`b`.`SLIP_DOCTOR`,`b`.`SLIP_TYPE`,`b`.`SLIP_SUB_TYPE`,`c`.`USER_NAME`,`d`.`DOCTOR_NAME`, `e`.*, `f`.`DEPARTMENT_NAME` FROM `me_service_slip` AS `a`  
            INNER JOIN `me_slip` AS `b` ON `b`.`SLIP_UUID` = `a`.`SLIP_REFERENCE_UUID`
            INNER JOIN `me_user` AS `c` ON `c`.`USER_UUID` = `a`.`STAFF_ID` 
            INNER JOIN `me_doctors` AS `d` ON `d`.`DOCTOR_UUID` = `b`.`SLIP_DOCTOR` 
            INNER JOIN `me_department` AS `f` ON `f`.`DEPARTMENT_UUID` = `b`.`SLIP_DEPARTMENT`
            INNER JOIN `me_patient` AS `e` ON `e`.`PATIENT_MR_ID` = `b`.`SLIP_MRID` 
            WHERE `a`.`SLIP_UUID` = '$sid'";
        }
    
    $sql = mysqli_query($db,$slipQuery);
    $slip_row = mysqli_fetch_array($sql);
    
    $slipId = $slip_row['SLIP_UUID'];
    $mrId = $slip_row['SLIP_MRID'];
    $name = $slip_row['SLIP_NAME'];
    $phone = $slip_row['SLIP_MOBILE'];
    $type = $slip_row['SLIP_TYPE'];
    if ($type != 'EMERGENCY') {
        $dept = $slip_row['DEPARTMENT_NAME'];
    }
    $doctor = $slip_row['DOCTOR_NAME'];
    $gender = $slip_row['PATIENT_GENDER'];
    $address = $slip_row['PATIENT_ADDRESS'];
    $age = $slip_row['PATIENT_AGE'];
    $date = $slip_row['SLIP_DATE_TIME'];
    if ($stype == 'FOLLOWUP_SLIP') {
        $fee = $slip_row['SLIP_FEE'];
    }
    if ($stype == 'SERVICE_SLIP') {
        $fee = $slip_row['SLIP_SERVICE_RATE'];
        $discount = $slip_row['SLIP_SERVICE_DISCOUNT'];
        $total = $slip_row['SLIP_SERVICE_TOTAL'];
    }
    
    $subType = $slip_row['SLIP_SUB_TYPE'];
    $staff = $slip_row['USER_NAME'];

?>
<div class="content-wrapper">
    <section class="container invoice">
        <div class="receipt">
        <div class="orderNo mb-0">MR ID# <b><?php echo $mrId; ?></b></div>
        <div class="orderNo">Slip ID# <b><?php echo $slipId; ?></b></div>
        <div class="headerSubTitle"><?php echo $date; ?></div>
        <div><img class="titleLogo" src="dist/img/hospital-logo.png" alt="Medeast Hospital Logo"></div>
        <div id="date">C-1 Commercial Office Block, Paragon City, Lahore.</div>
        <div id="date">042 37165549, 0320 4707070, 0300 4133102</div>
        <div class="headerSubTitle mt-2 mb-2">
        <?php 
            if ($stype == 'FOLLOWUP_SLIP') {
                echo 'Follow Up Slip';
            }else if ($stype == 'SERVICE_SLIP') {
                echo 'Service Slip';
            }
        ?>
        </div>

        <table class="table table-bordered table-custom">
            <tr>
                <td style="padding:0 !important;">&nbsp;<small>Name: </small></td>
                <td class="right-chars">&nbsp;<b><?php echo $name;?></b></td>
            </tr>
            <tr>
                <td style=" padding:0 !important;">&nbsp;<small>Phone</small></td>
                <td class="right-chars">&nbsp;<b><?php echo $phone; ?></b></td>
            </tr>
            <?php if ($type != "EMERGENCY") { ?>
            <tr>
                <td style=" padding:0 !important;">&nbsp;<small>Department</small></td>
                <td class="right-chars">&nbsp;<b><?php echo $dept; ?></b></td>
            </tr>
            <?php } ?>
            <tr>
                <td style=" padding:0 !important;">&nbsp;<small>Doctor</small></td>
                <td class="right-chars">&nbsp;<b><?php echo $doctor; ?></b></td>
            </tr>
            <tr>
                <td style=" padding:0 !important;">&nbsp;<small>Age/Gender</small></td>
                <td class="right-chars">&nbsp;<b><?php echo $age." yrs - ".$gender; ?></b></td>
            </tr>
        </table>
        <?php 
            if ($stype == 'FOLLOWUP_SLIP') {
        ?>
                <div class="flex">
            <div class="totals">
            <div class="section">
                    <div class="row">
                        <div class="col2"><b>Payment Method: </b></div>
                        <div class="col3"><b class="nxt">CASH</b></div>
                    </div>
                    <div class="row">
                        <div class="col2"><b>Consultant Fee: </b></div>
                        <div class="col3"><b class="nxt">&#8360;-<?php echo $fee; ?></b></div>
                    </div>
                    <div class="row">
                        <div class="col2"><b>Payable: </b></div>
                        <div class="col3"><b class="nxt">&#8360;-<?php echo $fee; ?></b></div>
                    </div>
                </div>
            </div>
        </div>
   
        <?php
            }
            if ($stype == 'SERVICE_SLIP') {
        ?>
            <div class="flex">
            <div class="totals">
                <div class="section">
                    <div class="row">
                        <div class="col2"><b>Payment Method: </b></div>
                        <div class="col3"><b class="nxt">CASH</b></div>
                    </div>
                    <div class="row">
                        <div class="col2"><b>Consultant Fee: </b></div>
                        <div class="col3"><b class="nxt">&#8360;-<?php echo $fee; ?></b></div>
                    </div>
                    <div class="row">
                        <div class="col2"><b>Discount: </b></div>
                        <div class="col3"><b class="nxt">&#8360;-<?php echo $discount; ?></b></div>
                    </div>
                    <div class="row">
                        <div class="col2"><b>Payable: </b></div>
                        <div class="col3"><b class="nxt">&#8360;-<?php echo $total; ?></b></div>
                    </div>
                </div>
            </div>
        </div>
        <?php  
          }
        ?>
        <div class="keepIt mt-2">Keep your slip!</div>
        <div class="keepItBody">Computer generated Receipt, Does not require signature or stamp. Bring this original receipt when revisiting MEDEAST.</div>
        <br>
        <div style="display:flex;">
            <div class="staffFooter">staff# <span><?php echo $staff; ?></span></div>
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