<?php 
// Session Start
session_start();
$sid = (isset($_GET['sid']) ? $_GET['sid'] : '');
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

       // Query to get Slip Details 
       $billSql ="SELECT `a`.*, `b`.`USER_NAME`, `c`.*	FROM `me_bill` AS `a` 
       INNER JOIN `me_user` AS `b` ON `b`.`USER_UUID` = `a`.`STAFF_ID` 
       INNER JOIN `me_emergency` AS `c` ON `c`.`EMERGENCY_UUID` = `a`.`BILL_UUID` WHERE `BILL_UUID` = '$sid'";
       $billsql = mysqli_query($db,$billSql);
       $bill_row = mysqli_fetch_array($billsql);

?>
      <div class="content-wrapper">
      <!-- Main content -->
      <section class="container invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-md-12">
            <center><h2 class="page-header">
              <img src="dist/img/medeast-logo-icon.png" alt="MedEast Logo"/> MEDEAST HOSPITAL
            </h2></center>
          </div>
          <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
        <!-- /.col -->
        <div class="col-sm-8 invoice-col">
            <b>MRD No# </b><?php echo $bill_row['BILL_MRID']; ?><br>
            <b>Patient Name : </b><?php echo $bill_row['BILL_NAME']; ?><br>
            <b>Contact No# </b> <?php echo $bill_row['BILL_MOBILE']; ?><br>
          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            <b>Bill Date :</b> <?php echo $bill_row['BILL_DATE_TIME']; ?><br>
            <b>Staff :</b> <?php echo $bill_row['USER_NAME']; ?><br>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- Table row -->
        <div class="row">
          <div class="col-12 table-responsive">
            <table class="table table-striped table-bordered">
              <thead>
              <tr style="width:100%;">
                <th style="width:80%;">Particular</th>
                <th style="width:20%;">Amount</th>
              </tr>
              </thead>
              <tbody>
              <?php
                if (!empty($bill_row['ES_MO_CHARGE'])) {
              ?>  
              <tr>
                <td>Emergency Slip / Medical Officer</td>
                <td><?php echo $bill_row['ES_MO_FEE']; ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['INJECTION_IM'])) {
              ?> 
              <tr>
                <td>Injection I/M</td>
                <td><?php echo $bill_row['INJECTION_IM']; ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['INJECTION_IV'])) {
              ?> 
              <tr>
                <td>Injection I/V</td>
                <td><?php echo $bill_row['INJECTION_IV']; ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['IV_LINE_IN_OUT'])) {
              ?>
              <tr>
                <td>I/V Line (In / Out)</td>
                <td><?php echo $bill_row['IV_LINE_IN_OUT']; ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['INFUSION_ANTIBIOTIC'])) {
              ?>
              <tr>
                <td>Infusion + Antibiotic</td>
                <td><?php echo $bill_row['INFUSION_ANTIBIOTIC']; ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['PER_STITCH_IN'])) {
              ?>
              <tr>
                <td>Per Stitch In</td>
                <td><?php echo $bill_row['PER_STITCH_IN']; ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['PER_STITCH_OUT'])) {
              ?>
              <tr>
                <td>Per Stitch Out</td>
                <td><?php echo $bill_row['PER_STITCH_OUT']; ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['BSF_BSR'])) {
              ?>
              <tr>
                <td>BSF / BSR</td>
                <td><?php echo $bill_row['BSF_BSR']; ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['SHORT_STAY'])) {
              ?>
              <tr>
                <td>Short Stay (Above 1st Hour)</td>
                <td><?php echo $bill_row['SHORT_STAY']; ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['BP'])) {
              ?>
              <tr>
                <td>Blood Pressure - BP</td>
                <td><?php echo $bill_row['BP'] ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['ECG'])) {
              ?>
              <tr>
                <td>ECG</td>
                <td><?php echo $bill_row['ECG'] ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['DRIP'])) {
              ?>
              <tr>
                <td>Drip (500ml / 1000ml)</td>
                <td><?php echo $bill_row['DRIP'] ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['DRIP_VENOFER'])) {
              ?>
              <tr>
                <td>Drip Venofar</td>
                <td><?php echo $bill_row['DRIP_VENOFER'] ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['DRESSING_SMALL_LARGE'])) {
              ?>
              <tr>
                <td>Dressing Charges</td>
                <td><?php echo $bill_row['DRESSING_SMALL_LARGE'] ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['NEBULIZATION'])) {
              ?>
              <tr>
                <td>Nebulization</td>
                <td><?php echo $bill_row['NEBULIZATION'] ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['MONITOR_CHARGE'])) {
              ?>
              <tr>
                <td>Monitor Charges (2-3 Hours)</td>
                <td><?php echo $bill_row['MONITOR_CHARGE'] ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['CTG'])) {
              ?>
              <tr>
                <td>CTG</td>
                <td><?php echo $bill_row['CTG'] ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['FOLEY_CATHETER'])) {
              ?>
              <tr>
                <td>Foley Catheter</td>
                <td><?php echo $bill_row['FOLEY_CATHETER'] ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['STOMACH_WASH'])) {
              ?>
              <tr>
                <td>Stomach WasH</td>
                <td><?php echo $bill_row['STOMACH_WASH'] ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['BLOOD_TRANSFUSION'])) {
              ?>
              <tr>
                <td>Blood Transfusion</td>
                <td><?php echo $bill_row['BLOOD_TRANSFUSION'] ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['ASCITIC_DIAGNOSTIC_THERAPEUTIC'])) {
              ?>
              <tr>
                <td>Ascitic (Diagnostic / Therapeutic)</td>
                <td><?php echo $bill_row['ASCITIC_DIAGNOSTIC_THERAPEUTIC'] ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['PLEURAL_FUID_THERAPEUTIC_DIAGNOSTIC'])) {
              ?>
              <tr>
                <td>Pleural Fuid (TAP Diagnostic / Therapeutic)</td>
                <td><?php echo $bill_row['PLEURAL_FUID_THERAPEUTIC_DIAGNOSTIC'] ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['ENDO_TRACHEAL_TUBE'])) {
              ?>
              <tr>
                <td>Endo Tracheal Tube</td>
                <td><?php echo $bill_row['ENDO_TRACHEAL_TUBE'] ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['ENEMA'])) {
              ?>
              <tr>
                <td>Enema</td>
                <td><?php echo $bill_row['ENEMA'] ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['LUMBER_PUNCTURE'])) {
              ?>
              <tr>
                <td>Lumber Puncture</td>
                <td><?php echo $bill_row['LUMBER_PUNCTURE'] ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['OTHER_TEXT_1'])) {
              ?>
              <tr>
                <td><?php echo $bill_row['OTHER_TEXT_1'] ?></td>
                <td><?php echo $bill_row['OTHER_1'] ?></td>
              </tr>
              <?php
                }
              if (!empty($bill_row['OTHER_TEXT_2'])) {
              ?>
              <tr>
                <td><?php echo $bill_row['OTHER_TEXT_2'] ?></td>
                <td><?php echo $bill_row['OTHER_2'] ?></td>
              </tr>
              <?php
              }
              if (!empty($bill_row['OTHER_TEXT_3'])) {
              ?>
              <tr>
                <td><?php echo $bill_row['OTHER_TEXT_3'] ?></td>
                <td><?php echo $bill_row['OTHER_3'] ?></td>
              </tr>
              <?php
              }
              if (!empty($bill_row['OTHER_TEXT_4'])) {
              ?>
              <tr>
                <td><?php echo $bill_row['OTHER_TEXT_4'] ?></td>
                <td><?php echo $bill_row['OTHER_4'] ?></td>
              </tr>
              <?php
              }
              if (!empty($bill_row['OTHER_TEXT_5'])) {
              ?>
              <tr>
              <td><?php echo $bill_row['OTHER_TEXT_5'] ?></td>
              <td><?php echo $bill_row['OTHER_5'] ?></td>
              </tr>
              <?php
              }
              if (!empty($bill_row['OTHER_TEXT_6'])) {
              ?>
              <tr>
                <td><?php echo $bill_row['OTHER_TEXT_6'] ?></td>
                <td><?php echo $bill_row['OTHER_6'] ?></td>
              </tr>
              <?php
              }
              if (!empty($bill_row['OTHER_TEXT_7'])) {
              ?>
              <tr>
                <td><?php echo $bill_row['OTHER_TEXT_7'] ?></td>
                <td><?php echo $bill_row['OTHER_7'] ?></td>
              </tr>
              <?php
              }
              if (!empty($bill_row['OTHER_TEXT_8'])) {
              ?>
              <tr>
                <td><?php echo $bill_row['OTHER_TEXT_8'] ?></td>
                <td><?php echo $bill_row['OTHER_8'] ?></td>
              </tr>
              <?php
                }
              if (!empty($bill_row['OTHER_TEXT_9'])) {
              ?>
              <tr>
                <td><?php echo $bill_row['OTHER_TEXT_9'] ?></td>
                <td><?php echo $bill_row['OTHER_9'] ?></td>
              </tr>
              <?php
              }
              if (!empty($bill_row['OTHER_TEXT_10'])) {
              ?>
              <tr>
                <td><?php echo $bill_row['OTHER_TEXT_10'] ?></td>
                <td><?php echo $bill_row['OTHER_10'] ?></td>
              </tr>
              <?php
              }
              if (!empty($bill_row['OTHER_TEXT_11'])) {
              ?>
              <tr>
                <td><?php echo $bill_row['OTHER_TEXT_11'] ?></td>
                <td><?php echo $bill_row['OTHER_11'] ?></td>
              </tr>
              <?php
              }
              if (!empty($bill_row['OTHER_TEXT_12'])) {
              ?>
              <tr>
                <td><?php echo $bill_row['OTHER_TEXT_12'] ?></td>
                <td><?php echo $bill_row['OTHER_12'] ?></td>
              </tr>
              <?php
              }
              ?>
              </tbody>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <!-- accepted payments column -->
          <div class="col-6"></div>
          <!-- /.col -->
          <div class="col-6">
            <!-- <p class="lead">Amount Due <?php //echo $bill_row['BILL_DATE_TIME']; ?></p> -->

            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th style="width:50%">Total Amount:</th>
                  <td>PKR - <?php echo $bill_row['BILL_AMOUNT']; ?></td>
                </tr>
                  <?php if (!empty($bill_row['BILL_DISCOUNT']) || $bill_row['BILL_DISCOUNT'] != 0) { ?>
                  <tr>
                    <th>Discount:</th>
                    <td>PKR - <?php echo $bill_row['BILL_DISCOUNT']; ?></td>
                  </tr>
                <?php } if (!empty($bill_row['BILL_TOTAL']) || (!empty($bill_row['BILL_DISCOUNT']))) { ?>
                <tr>
                  <th>Payables:</th>
                  <td>PKR - <?php echo $bill_row['BILL_TOTAL']; ?></td>
                </tr>
                <?php } ?>
              </table>
            </div>
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