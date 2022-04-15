<?php 
  session_start();
  $pname = (isset($_GET['pname']) ? $_GET['pname'] : '');
  $saveOn = (isset($_GET['adddate']) ? $_GET['adddate'] : '');
  $mrid = (isset($_GET['mrid']) ? $_GET['mrid'] : '');
  $phone = (isset($_GET['phone']) ? $_GET['phone'] : '');
  $cnic = (isset($_GET['cnic']) ? $_GET['cnic'] : '');
  $gender = (isset($_GET['gender']) ? $_GET['gender'] : '');
  $doctor = (isset($_GET['doc']) ? $_GET['doc'] : '');
  $age = (isset($_GET['age']) ? $_GET['age'] : '');
  $type = (isset($_GET['type']) ? $_GET['type'] : '');
  $procedure = (isset($_GET['pro']) ? $_GET['pro'] : '');
  $address = (isset($_GET['add']) ? $_GET['add'] : '');
  $by = (isset($_GET['by']) ? $_GET['by'] : '');

  $adm = (isset($_GET['adm']) ? $_GET['adm'] : '');
  $adcharge = (isset($_GET['adcharge']) ? $_GET['adcharge'] : '');
  $surcharge = (isset($_GET['surcharge']) ? $_GET['surcharge'] : '');
  $anescharge = (isset($_GET['anescharge']) ? $_GET['anescharge'] : '');
  $opcharge = (isset($_GET['opcharge']) ? $_GET['opcharge'] : '');
  $chargelr = (isset($_GET['chargelr']) ? $_GET['chargelr'] : '');
  $pedcharge = (isset($_GET['pedcharge']) ? $_GET['pedcharge'] : '');
  $prcharge = (isset($_GET['prcharge']) ? $_GET['prcharge'] : '');
  $nurcharge = (isset($_GET['nurcharge']) ? $_GET['nurcharge'] : '');
  $nurstcharge = (isset($_GET['nurstcharge']) ? $_GET['nurstcharge'] : '');
  $mocharge = (isset($_GET['mocharge']) ? $_GET['mocharge'] : '');
  $concharge = (isset($_GET['concharge']) ? $_GET['concharge'] : '');
  $ctg = (isset($_GET['ctg']) ? $_GET['ctg'] : '');
  $rrcharge = (isset($_GET['rrcharge']) ? $_GET['rrcharge'] : '');
  $other = (isset($_GET['other']) ? $_GET['other'] : '');
  $tbill = (isset($_GET['tbill']) ? $_GET['tbill'] : '');
  $dis = (isset($_GET['dis']) ? $_GET['dis'] : '');
  $fbill = (isset($_GET['fbill']) ? $_GET['fbill'] : '');

  $date = substr($saveOn,0, 24);
    
  $newType;
    
    if ($type == 'gynae') {
        $newType = 'Gynae Patient';
    }else if ($type == 'gensurgery') {
        $newType = 'General Surgery Patient';
    }else if ($type == 'genillness') {
        $newType = 'General Illness Patient';
    }else if ($type == 'eye') {
        $newType = 'Eye Patient';
    }
?>
  <!-- Header Form -->
  <?php include('backend_components/connection.php'); ?>
  <!-- Header Form -->

  <?php
    // $deptSql ="SELECT `DEPARTMENT_NAME` FROM `department` WHERE `DEPARTMENT_ID` =".$department;
    // $docSql ="SELECT `DOCTOR_NAME` FROM `doctor` WHERE `DOCTOR_ID` =".$doctor;
    $adminSql ="SELECT `ADMIN_USERNAME` FROM `admin` WHERE `ADMIN_ID` =".$by;
    // $dptsql = mysqli_query($db,$deptSql);
    // $dept_row = mysqli_fetch_array($dptsql);
    // $dsql = mysqli_query($db,$docSql);
    // $doctor_row = mysqli_fetch_array($dsql);
    $asql = mysqli_query($db,$adminSql);
    $admin_row = mysqli_fetch_array($asql);
  ?>

  <?php include('components/form_header.php'); ?>
  <!-- Navbar -->
  <?php include('components/navbar.php'); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include('components/sidebar.php'); ?>
  <!-- /.Main Sidebar Container-->

<div class="content-wrapper">
  <!-- Main content -->
  <section class="container invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header">
          <img src="dist/img/medeast-logo-icon.png" alt="MedEast Logo"/><b> MEDEAST HOSPITAL</b>
          <small class="float-right" style="font-size:12px;">Slip Date: <?php echo $saveOn; ?></small>
        </h2>
        <div class="float-right" style="margin-top: -125px;">
        <div style="display:flex;">
         <div style="margin:5px 10px;font-size:30px;"><i class="fas fa-map"></i></div>
         <div style="font-size:15px;">C-1 Commercial Office Block, <br> Paragon City, Lahore.</div>
        </div>
        <div style="display:flex;">
        <div style="margin:15px 10px;font-size:30px;"><i class="fas fa-phone"></i></div> 
        <div style="font-size:15px;">
              0300 4133102 <br>
              0320 4707070 <br>
              042 37165549
        </div>
        </div>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
     <!-- /.col -->
     <div class="col-sm-6 invoice-col">
     <hr style="margin-top:5px;"/>
        <p><b>MR_ID# </b><?php echo $mrid; ?></P>
        <p><b>Patient Name :</b> <?php echo $pname; ?></p>
        <p><b>Contact :</b> <?php echo $phone; ?></P>
        <p><b>CNIC No. :</b> <?php echo $cnic; ?></P>
        <p><b>Consultant :</b> <?php echo $doctor; ?></p>
        <p><b>Procedure :</b> <?php echo $procedure; ?></p>
       
      </div>
      <!-- /.col -->
      <div class="col-sm-6 invoice-col">
      <hr style="margin-top:5px;"/>
        <p><b>Patient Type :</b> <?php echo $newType; ?></p>
        <p><b>Age :</b> <?php echo $age; ?> | <?php echo $gender; ?></p>
        <!-- <h4><b>Gender :</b> <?php //echo $gender; ?></h4><br> -->
        <p><b>Address :</b> <?php echo $address; ?></p>
        <p><b>Date/Time Range :</b> <?php echo $adm; ?></p>
        <p><b>Staff :</b> <?php echo $admin_row['ADMIN_USERNAME'];; ?></p>
        <!-- <h4><b>Time :</b> <?php //echo $saveOn; ?></h4><br> -->
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
            <td>Admission Charges</td>
            <td><?php echo $adcharge; ?></td>
          </tr>
          <tr>
            <td>Surgeon Charges</td>
            <td><?php echo $surcharge; ?></td>
          </tr>
          <tr>
            <td>Anesthetist Charges</td>
            <td><?php echo $anescharge; ?></td>
          </tr>
          <tr>
            <td>Operation Charges</td>
            <td><?php echo $opcharge; ?></td>
          </tr>
          <tr>
            <td>Labour Room Charges</td>
            <td><?php echo $chargelr; ?></td>
          </tr>
          <tr>
            <td>Pediatric Charges</td>
            <td><?php echo $pedcharge; ?></td>
          </tr>
          <tr>
            <td>Nursury Charges</td>
            <td><?php echo $nurcharge; ?></td>
          </tr>
          <tr>
            <td>Nursury Staff Charges</td>
            <td><?php echo $nurstcharge; ?></td>
          </tr>
          <tr>
            <td>M O Charges</td>
            <td><?php echo $mocharge; ?></td>
          </tr>
          <tr>
            <td>Consultant Visit Charges</td>
            <td><?php echo $concharge; ?></td>
          </tr>
          <tr>
            <td>CTG Charges</td>
            <td><?php echo $ctg; ?></td>
          </tr>
          <tr>
            <td>Recovery Room Charges</td>
            <td><?php echo $rrcharge; ?></td>
          </tr>
          <tr>
            <td>Private Room Charges</td>
            <td><?php echo $prcharge; ?></td>
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
            <!-- <tr>
              <th>Tax (9.3%)</th>
              <td>$10.34</td>
            </tr> -->
            <tr>
              <th>Discount:</th>
              <td>PKR - <?php echo $dis; ?></td>
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
<script>
  window.addEventListener("load", window.print());
</script>
 <!-- Main Footer -->
 <?php include('components/footer.php'); ?>
  <!-- /. Main Footer -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<?php include('components/form_script.php'); ?>