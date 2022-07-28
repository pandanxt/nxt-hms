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
?>
        <!-- START RECEIPT -->
            <div class="receipt">
                <img class="watermark" src="dist/img/medeast-logo-icon.png">
                <div class="orderNo">
                Slip ID# <span id="Order #"><?php echo $dept_row['SLIP_MR_ID']; ?></span> - <span id="Order Name">OPD</span>
                </div>
                <div class="headerSubTitle">
                <?php echo $dept_row['SLIP_DATE_TIME']; ?>
                </div>
                <div class="headerTitle">
                Medeast Hospital
                </div>
                <div class="headerSubTitle">
                OPD Patient
                </div>
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
                    <table class="table table-condensed" style="font-size: 1.2vw;padding: 0rem !important;">
                        <tr>
                            <td class="left-chars">Name </td>
                            <td class="right-chars"><?php echo $dept_row['SLIP_NAME']; ?></td>
                        </tr>
                        <tr>
                            <td class="left-chars">Mobile </td>
                            <td class="right-chars"><?php echo $dept_row['SLIP_MOBILE']; ?></td>
                        </tr>
                        <tr>
                            <td class="left-chars">Dept </td>
                            <td class="right-chars"><?php echo $dept_row['DEPARTMENT_NAME']; ?></td>
                        </tr>
                        <tr>
                            <td class="left-chars">Doctor </td>
                            <td class="right-chars"><?php echo $dept_row['DOCTOR_NAME']; ?></td>
                        </tr>
                        <tr>
                            <td class="left-chars">Gender</td>
                            <td class="right-chars"><?php echo $age." years - ".$gender; ?></td>
                        </tr>
                    </table>
                <!-- Items Purchased -->
            <div class="flex">
                <!-- <div id="qrcode"></div> -->
                <div class="totals">
                    <div class="section">
                    <div class="row">
                        <div class="col1"></div>
                        <div class="col2">Payment: </div>
                        <div class="col3"><b>CASH</b></div>
                    </div>
                    <div class="row">
                        <div class="col1"></div>
                        <div class="col2">Consultant Fee: </div>
                        <div class="col3">&#8360;<b><?php echo $dept_row['SLIP_FEE']; ?></b></div>
                    </div>
                    </div>
                    <div class="section">
                    <div class="row">
                        <div class="col1"></div>
                        <div class="col2">Payable: </div>
                        <div class="col3">&#8360;<b><?php echo $dept_row['SLIP_FEE']; ?></b></div>
                    </div>
                    </div>
                    
                </div>
                </div>
            <div class="keepIt">
                Keep your slip!
                </div>
                <div class="keepItBody">
                Computerized generated slip, no need of signature or stamp. Bring this original slip when revisiting MEDEAST Hospital.
                </div>
            </div>
        <!-- <script src="script.js"></script>
    </body>
</html> -->
 <script> 
    setTimeout(() => {
        window.addEventListener("load", window.print());       
    }, 1000);
 </script>
 <?php
//  include('components/footer.php'); 
 echo '</div>';
 include('components/form_script.php');
 }
}else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
} 
?>