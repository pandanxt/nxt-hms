<?php 
 // Session Start
 session_start();
 $sid = (isset($_GET['sid']) ? $_GET['sid'] : '');
 $slip = (isset($_GET['type']) ? $_GET['type'] : '');
//  $slip = (isset($_GET['slip']) ? $_GET['slip'] : '');

if (isset($_SESSION['uuid'])) {  
  // Connection File
  include('backend_components/connection.php');
  // File Header
  include('components/file_header.php');;
  // Navbar File
  include('components/navbar.php');
  // Sidbar File
  include('components/sidebar.php');

    if($sid) {
        // Query to get Outdoor Slip Details
        if ($slip == 'FOLLOWUP_SLIP') {
           
            $slipQuery ="SELECT `a`.*,`b`.`SLIP_MRID`,`b`.`SLIP_NAME`,`b`.`SLIP_MOBILE`,`b`.`SLIP_DOCTOR`,`b`.`SLIP_TYPE`,`b`.`SLIP_SUB_TYPE`,`c`.`USER_NAME`,`d`.`DOCTOR_NAME`, `e`.*  FROM `me_followup_slip` AS `a`  
            INNER JOIN `me_slip` AS `b` ON `b`.`SLIP_UUID` = `a`.`SLIP_REFERENCE_UUID`
            INNER JOIN `me_user` AS `c` ON `c`.`USER_UUID` = `a`.`STAFF_ID` 
            INNER JOIN `me_doctors` AS `d` ON `d`.`DOCTOR_UUID` = `b`.`SLIP_DOCTOR`
            INNER JOIN `me_patient` AS `e` ON `e`.`PATIENT_MR_ID` = `b`.`SLIP_MRID` 
            WHERE `a`.`SLIP_UUID` = '$sid'";
            
        }else if($slip == 'SERVICE_SLIP') {
            
            $slipQuery ="SELECT `a`.*,`b`.`SLIP_MRID`,`b`.`SLIP_NAME`,`b`.`SLIP_MOBILE`,`b`.`SLIP_DOCTOR`,`b`.`SLIP_TYPE`,`b`.`SLIP_SUB_TYPE`,`c`.`USER_NAME`,`d`.`DOCTOR_NAME`, `e`.* FROM `me_service_slip` AS `a`  
            INNER JOIN `me_slip` AS `b` ON `b`.`SLIP_UUID` = `a`.`SLIP_REFERENCE_UUID`
            INNER JOIN `me_user` AS `c` ON `c`.`USER_UUID` = `a`.`STAFF_ID` 
            INNER JOIN `me_doctors` AS `d` ON `d`.`DOCTOR_UUID` = `b`.`SLIP_DOCTOR` 
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
    
    $doctor = $slip_row['DOCTOR_NAME'];
    $gender = $slip_row['PATIENT_GENDER'];
    $address = $slip_row['PATIENT_ADDRESS'];
    $age = $slip_row['PATIENT_AGE'];
    $date = $slip_row['SLIP_DATE_TIME'];
    if ($slip == 'FOLLOWUP_SLIP') {
        $fee = $slip_row['SLIP_FEE'];
    }
    if ($slip == 'SERVICE_SLIP') {
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
        <!-- <div class="orderNo">Slip ID# <b><?php //echo $slipId; ?></b></div> -->
        <div class="headerSubTitle"><?php echo $date; ?></div>
        <div><img class="titleLogo" src="dist/img/hospital-logo.png" alt="MAAN Medical Logo"></div>
        <!-- <div id="date">C-1 Commercial Office Block,</br> Paragon City, Lahore.</div>
        <div id="date">042 37165549, 0320 4707070, 0300 4133102</div> -->
        <div class="headerSubTitle mt-2 mb-2">
        <?php 
            if ($slip == 'FOLLOWUP_SLIP') {
                echo 'FollowUp Slip';
            }else if ($slip == 'SERVICE_SLIP') {
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
            if ($slip == 'FOLLOWUP_SLIP') {
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
            if ($slip == 'SERVICE_SLIP') {
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
        <div class="keepItBody">Computer generated Receipt, Does not require signature or stamp. Bring this original receipt when revisiting MAAN Medical & Gynaecological Complex.</div>
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
    // REQUIRED SCRIPTS 
    include('components/file_footer.php');
}else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
} 
?>