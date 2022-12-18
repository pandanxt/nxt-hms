<?php
  // Session Start
  session_start();
  if (isset($_SESSION['uuid'])) { 
  // Connection File
  include('backend_components/connection.php');
  // File Header
  include('components/file_header.php');
  // Navbar File 
  include('components/navbar.php'); 
  // Main Sidebar Container
  include('components/sidebar.php'); 
?>

<div class="content-wrapper">
    <div class="content-header"></div>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-2 col-6">
            <?php
              $patient = mysqli_query($db,"SELECT COUNT(`PATIENT_MR_ID`) FROM `me_patient`");
              $row = mysqli_fetch_array($patient);
              $patTotal = $row[0];
            ?>
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h2><?php echo $patTotal; ?></h2>  
                <small>Total</small>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="patient_record.php" class="small-box-footer">
              Patients <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <!-- ./col -->
          <div class="col-lg-2 col-6">
            <?php
              $emBill = mysqli_query($db,"SELECT COUNT(`SLIP_UUID`) FROM `me_slip`");
              $row = mysqli_fetch_array($emBill);
              $emSlipTotal = $row[0];
            ?>
            
            <div class="small-box bg-info">
              <div class="inner">
                <h2><?php echo $emSlipTotal; ?></h2>

                <small>Total</small>
              </div>
              <div class="icon">
                <i class="fas fa-user-injured"></i>
              </div>
              <a href="slips.php" class="small-box-footer">
              Slips <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-6">
            <?php
              $emergency = mysqli_query($db,"SELECT COUNT(`SLIP_UUID`) FROM `me_slip` WHERE `SLIP_TYPE` = 'EMERGENCY'");
              $row = mysqli_fetch_array($emergency);
              $emTotal = $row[0];
            ?>
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h2><?php echo $emTotal; ?></h2>
                <small>Emergency</small>
              </div>
              <div class="icon">
                <i class="fas fa-user-injured"></i>
              </div>
              <a href="slips.php" class="small-box-footer">
              Slips <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-2 col-6">
          <?php
              $indoor = mysqli_query($db,"SELECT COUNT(`SLIP_UUID`) FROM `me_slip` WHERE `SLIP_TYPE` = 'INDOOR'");
              $row = mysqli_fetch_array($indoor);
              $inTotal = $row[0];
            ?>
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h2><?php echo $inTotal; ?></h2>
                <small>Indoor</small>
              </div>
              <div class="icon">
                <i class="fas fa-procedures"></i>
              </div>
              <a href="slips.php" class="small-box-footer">
              Slips <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-6">
            <?php
              $outdoor = mysqli_query($db,"SELECT COUNT(`SLIP_UUID`) FROM `me_slip` WHERE `SLIP_TYPE` = 'OUTDOOR'");
              $row = mysqli_fetch_array($outdoor);
              $outTotal = $row[0];
            ?>
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h2><?php echo $outTotal; ?></h2>

                <small>Outdoor</small>
              </div>
              <div class="icon">
                <i class="fas fa-user"></i>
              </div>
              <a href="slips.php" class="small-box-footer">
              Slips <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
           <!-- ./col -->
           <!-- ./col -->
           <div class="col-lg-2 col-6">
           <?php
              $bill = mysqli_query($db,"SELECT COUNT(`BILL_UUID`) FROM `me_bill`");
              $row = mysqli_fetch_array($bill);
              $emBillTotal = $row[0];
            ?>
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h2><?php echo $emBillTotal; ?></h2>

                <small>Total</small>
              </div>
              <div class="icon">
                <i class="fas fa-procedures"></i>
              </div>
              <a href="bill_records.php" class="small-box-footer">
              Bills <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- // Main Footer  -->
  <?php include('components/footer.php'); ?>
  <!-- /. Main Footer -->
</div>
<!-- ./wrapper -->
<?php
  // REQUIRED SCRIPTS 
  include('components/file_footer.php');

  }else{
    echo '<script type="text/javascript">window.location = "login.php";</script>';
  } 
?>
