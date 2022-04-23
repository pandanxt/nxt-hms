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

       $slipSql ="SELECT `a`.*, `b`.`DOCTOR_NAME` 
        FROM `emergency_slip` AS `a` INNER JOIN `doctor` AS `b` ON `b`.`DOCTOR_ID` = `a`.`DOCTOR_ID`
        WHERE `SLIP_ID` = '$bill_row[SLIP_ID]'";
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
              <tr>
                <td>Emergency Slip / Medical Officer</td>
                <td><?php echo $bill_row['ES_MO_CHARGE']; ?></td>
              </tr>
              <tr>
                <td>Injection I/M</td>
                <td><?php echo $bill_row['INJECTION_IM']; ?></td>
              </tr>
              <tr>
                <td>Injection I/V</td>
                <td><?php echo $bill_row['INJECTION_IV']; ?></td>
              </tr>
              <tr>
                <td>I/V Line (In / Out)</td>
                <td><?php echo $bill_row['IV_LINE']; ?></td>
              </tr>
              <tr>
                <td>I/V infusion (100ml,200ml,1000ml)</td>
                <td><?php echo $bill_row['IV_INFUSION']; ?></td>
              </tr>
              <tr>
                <td>Per Stitch in x 300</td>
                <td><?php echo $bill_row['PS_IN_300']; ?></td>
              </tr>
              <tr>
                <td>Per Stitch Out x 100</td>
                <td><?php echo $bill_row['PS_OUT_100']; ?></td>
              </tr>
              <tr>
                <td>BSF / BSR</td>
                <td><?php echo $bill_row['BSF_BSR']; ?></td>
              </tr>
              <tr>
                <td>Short Stay (After 1st Hour)</td>
                <td><?php echo $bill_row['SHORT_STAY']; ?></td>
              </tr>
              <tr>
                <td>Blood Pressure - BP</td>
                <td><?php echo $bill_row['BP'] ?></td>
              </tr>
              <tr>
                <td>ECG</td>
                <td><?php echo $bill_row['ECG'] ?></td>
              </tr>
              <tr>
                <td>Other</td>
                <td><?php echo $bill_row['OTHER'] ?></td>
              </tr>
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
                  <th style="width:50%">Subtotal:</th>
                  <td>PKR - <?php echo $bill_row['TOTAL_AMOUNT']; ?></td>
                </tr>
                <tr>
                  <th>Discount:</th>
                  <td>PKR - <?php echo $bill_row['DISCOUNT']; ?></td>
                </tr>
                <tr>
                  <th>Total:</th>
                  <td>PKR - <?php echo $bill_row['TOTAL']; ?></td>
                </tr>
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
    }else {
              // Get Variables from Url
          $pname = (isset($_GET['pname']) ? $_GET['pname'] : '');
          $saveOn = (isset($_GET['on']) ? $_GET['on'] : '');
          $mrid = (isset($_GET['mrid']) ? $_GET['mrid'] : '');
          $phone = (isset($_GET['phone']) ? $_GET['phone'] : '');
          $by = (isset($_GET['by']) ? $_GET['by'] : '');

          $mo = (isset($_GET['mo']) ? $_GET['mo'] : '');
          $injectionim = (isset($_GET['injectionim']) ? $_GET['injectionim'] : '');
          $injectioniv = (isset($_GET['injectioniv']) ? $_GET['injectioniv'] : '');
          $ivline = (isset($_GET['ivline']) ? $_GET['ivline'] : '');
          $sin = (isset($_GET['sin']) ? $_GET['sin'] : '');
          $sout = (isset($_GET['sout']) ? $_GET['sout'] : '');
          $ivinfection = (isset($_GET['ivinfection']) ? $_GET['ivinfection'] : '');
          $bsf = (isset($_GET['bsf']) ? $_GET['bsf'] : '');
          $sstay = (isset($_GET['sstay']) ? $_GET['sstay'] : '');
          $bp = (isset($_GET['bp']) ? $_GET['bp'] : '');
          $ecg = (isset($_GET['ecg']) ? $_GET['ecg'] : '');
          $other = (isset($_GET['other']) ? $_GET['other'] : '');

          $tbill = (isset($_GET['tbill']) ? $_GET['tbill'] : '');
          $disc = (isset($_GET['disc']) ? $_GET['disc'] : '');
          $fbill = (isset($_GET['fbill']) ? $_GET['fbill'] : '');

          $date = substr($saveOn,0, 24);

          //Get Username Query
          $adminSql ="SELECT `ADMIN_USERNAME` FROM `admin` WHERE `ADMIN_ID` =".$by;
          $asql = mysqli_query($db,$adminSql);
          $admin_row = mysqli_fetch_array($asql);

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
                <b>MR_ID# </b><?php echo $mrid; ?><br>
                <b>Patient Name : </b><?php echo $pname; ?><br>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                <b>Contact :</b> <?php echo $phone; ?><br>
                <!-- <b>Medical Officer :</b> 2/22/2014<br> -->
                <b>Date/Time :</b> <?php echo $date; ?><br>
                <b>Staff :</b> <?php echo $admin_row['ADMIN_USERNAME']; ?><br>
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
                  <tr>
                    <td>Emergency Slip / Medical Officer</td>
                    <td><?php echo $mo; ?></td>
                  </tr>
                  <tr>
                    <td>Injection I/M</td>
                    <td><?php echo $injectionim; ?></td>
                  </tr>
                  <tr>
                    <td>Injection I/V</td>
                    <td><?php echo $injectioniv; ?></td>
                  </tr>
                  <tr>
                    <td>I/V Line (In / Out)</td>
                    <td><?php echo $ivline; ?></td>
                  </tr>
                  <tr>
                    <td>I/V infusion (100ml,200ml,1000ml)</td>
                    <td><?php echo $sin; ?></td>
                  </tr>
                  <tr>
                    <td>Per Stitch in x 300</td>
                    <td><?php echo $sout; ?></td>
                  </tr>
                  <tr>
                    <td>Per Stitch Out x 100</td>
                    <td><?php echo $ivinfection; ?></td>
                  </tr>
                  <tr>
                    <td>BSF / BSR</td>
                    <td><?php echo $bsf; ?></td>
                  </tr>
                  <tr>
                    <td>Short Stay (After 1st Hour)</td>
                    <td><?php echo $sstay; ?></td>
                  </tr>
                  <tr>
                    <td>Blood Pressure - BP</td>
                    <td><?php echo $bp; ?></td>
                  </tr>
                  <tr>
                    <td>ECG</td>
                    <td><?php echo $ecg; ?></td>
                  </tr>
                  <tr>
                    <td>Other</td>
                    <td><?php echo $other; ?></td>
                  </tr>
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
                      <th style="width:50%">Subtotal:</th>
                      <td>PKR - <?php echo $tbill; ?></td>
                    </tr>
                    <tr>
                      <th>Discount:</th>
                      <td>PKR - <?php echo $disc; ?></td>
                    </tr>
                    <tr>
                      <th>Total:</th>
                      <td>PKR - <?php echo $fbill; ?></td>
                    </tr>
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