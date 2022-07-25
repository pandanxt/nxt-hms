<?php 
// Session Start
session_start();
$sid = (isset($_GET['sid']) ? $_GET['sid'] : '');
if (isset($_SESSION['userid'])) {  
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
       $billSql ="SELECT `a`.*, `b`.`ADMIN_USERNAME`	FROM `emergency_bill` AS `a` INNER JOIN `admin` AS `b` ON `b`.`ADMIN_ID` = `a`.`CREATED_BY` WHERE `BILL_ID` = ".$sid;
       $billsql = mysqli_query($db,$billSql);
       $bill_row = mysqli_fetch_array($billsql);

       $date = substr($bill_row['DATE_TIME'],0, 24);

       $slipSql ="SELECT * FROM `emergency_slip` WHERE `SLIP_ID` = '$bill_row[SLIP_ID]'";
       $slipsql = mysqli_query($db,$slipSql);
       $slip_row = mysqli_fetch_array($slipsql);
     
       $doctor = $slip_row['DOCTOR_NAME'];
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
            <b>MR_ID# </b><?php echo $bill_row['MR_ID']; ?><br>
            <b>Patient Name : </b><?php echo $bill_row['PATIENT_NAME']; ?><br>
            <b>Contact :</b> <?php echo $bill_row['MOBILE']; ?><br>
          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            <b>Date/Time :</b> <?php echo $date; ?><br>
            <b>Staff :</b> <?php echo $bill_row['ADMIN_USERNAME']; ?><br>
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
                <td><?php echo $bill_row['ES_MO_CHARGE']; ?></td>
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
                if (!empty($bill_row['IV_LINE'])) {
              ?>
              <tr>
                <td>I/V Line (In / Out)</td>
                <td><?php echo $bill_row['IV_LINE']; ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['IV_INFUSION'])) {
              ?>
              <tr>
                <td>I/V infusion (100ml,200ml,1000ml)</td>
                <td><?php echo $bill_row['IV_INFUSION']; ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['PS_IN_300'])) {
              ?>
              <tr>
                <td>Per Stitch in x 300</td>
                <td><?php echo $bill_row['PS_IN_300']; ?></td>
              </tr>
              <?php
                }
                if (!empty($bill_row['PS_OUT_100'])) {
              ?>
              <tr>
                <td>Per Stitch Out x 100</td>
                <td><?php echo $bill_row['PS_OUT_100']; ?></td>
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
                <td>Short Stay (After 1st Hour)</td>
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
            <p class="lead">Amount Due <?php echo $date; ?></p>

            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th style="width:50%">Total Amount:</th>
                  <td>PKR - <?php echo $bill_row['TOTAL_AMOUNT']; ?></td>
                </tr>
                  <?php if (!empty($bill_row['DISCOUNT']) || $bill_row['DISCOUNT'] != 0) { ?>
                  <tr>
                    <th>Discount:</th>
                    <td>PKR - <?php echo $bill_row['DISCOUNT']; ?></td>
                  </tr>
                <?php } if (!empty($bill_row['TOTAL']) || (!empty($bill_row['DISCOUNT']))) { ?>
                <tr>
                  <th>Payables:</th>
                  <td>PKR - <?php echo $bill_row['TOTAL']; ?></td>
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