<?php 
  session_start(); 
  $mrid = (isset($_GET['mrid']) ? $_GET['mrid'] : ''); 
?>
<!-- Header Form -->
  <?php include('backend_components/connection.php'); ?>
  <!-- Header Files -->
  <?php include('components/form_header.php'); ?>
  <!-- Navbar -->
  <?php include('components/navbar.php'); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include('components/sidebar.php'); ?>
  <!-- /.Main Sidebar Container-->

  <!-- Content Wrapper. Contains page content -->
  <?php 
    if (empty($_GET['mrid'])) {
      include('components/simple_bill_form.php');  
      // echo '<script>alert("This is simplet bill form");</script>';
    } else {
        // echo'<script>console.log("This is the MR ID"'.$mrid.');</script>';
      $sql="SELECT *, `DOCTOR_NAME` FROM `emergency_patient` INNER JOIN `doctor` WHERE `PATIENT_MR_ID` = '$mrid' AND `emergency_patient`.`DOCTOR_ID` = `doctor`.`DOCTOR_ID`";
      $qsql = mysqli_query($db,$sql);
      $patdata = mysqli_fetch_array($qsql);
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h3 class="card-title p-3"><a href="javascript:history.go(-1)"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;Back</a></h3>
            <!-- <h1>Generate Bill for <?php //echo $patdata['PATIENT_NAME'] ; ?></h1> -->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Generate Bill</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
    
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"><i class="nav-icon fas fa-hospital-user"></i> MedEast Patient Bill</h3>

            <div class="card-tools">
              <span id='clockDT'></span>
            </div>
          </div>
          <form action="backend_components/php_handler.php" method="post" enctype="multipart/form-data">
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="phone" value="<?php echo $patdata['PATIENT_MOBILE'] ; ?>" hidden readonly>
                    <input type="text" name="mrid" value="<?php echo $patdata['PATIENT_MR_ID'] ; ?>" hidden readonly>
                    <input type="text" name="name" value="<?php echo $patdata['PATIENT_NAME'] ; ?>" hidden readonly>
                    <input type="text" name="gender" value="<?php echo $patdata['PATIENT_GENDER'] ; ?>" hidden readonly>
                    <input type="text" name="type" value="<?php echo $patdata['PATIENT_TYPE'] ; ?>" hidden readonly>
                    <input type="text" name="doctor" value="<?php echo $patdata['DOCTOR_NAME'] ; ?>" hidden readonly>
                    <input type="text" name="by" value="<?php echo $_SESSION['userid'] ; ?>" hidden readonly>

                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-6">
                        <label>Patient MR_ID</label>
                        <input type="text" class="form-control" name="mrid" id="" value="<?php echo $patdata['PATIENT_MR_ID'] ; ?>" readonly/>
                        </div>
                        <div class="form-group col-md-6">
                        <label>Patient Name</label>
                        <input type="text" name="name" class="form-control" id="" value="<?php echo $patdata['PATIENT_NAME'] ; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-6">
                        <label>Emergency Slip / Medical Officer</label>
                        <input type="number" name="medicalofficer" id="medicalOfficer" placeholder="General Charges is 500" class="form-control"/>
                        </div>
                        <div class="form-group col-md-6">
                        <label>Injection I/M</label>
                        <input type="number" name="injectionim" class="form-control" id="injectionIM" placeholder="General Rate is 100">
                        </div>
                    </div>
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-6">
                        <label>Injection I/V</label>
                        <input type="number" class="form-control" name="injectioniv" id="injectionIV" placeholder="General Rate is 200"/>
                        </div>
                        <div class="form-group col-md-6">
                        <label>I/V Line (In / Out)</label>
                        <!-- <input type="number" name="ivline" class="form-control" id="ivLine" placeholder="Total Value"/> -->
                        <select class="form-control select2bs4" name="ivline" id="ivLine" style="width: 100%;">
                          <option selected="selected" disabled>Select I/V Line (In / Out)</option>
                          <option value="200">In - 200</option>
                          <option value="100">Out - 100</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-6">
                        <label>I/V infusion</label>
                        <!-- <input type="number" name="admitDay" onchange="myDayFunction(this)" id="day" placeholder="Admit Day" class="form-control"/> -->
                        <select class="form-control select2bs4" name="ivinfusion" id="ivInfusion" style="width: 100%;">
                          <option selected="selected" disabled>Select I/V Infusion (100ml / 200ml / 1000ml)</option>
                          <option value="200">100ml - 200</option>
                          <option value="500">200ml - 500</option>
                          <option value="1000">1000ml - 1000</option>
                        </select>
                        </div>
                        <div class="form-group col-md-6">
                        <label>Per Stitch In x 300</label>
                        <input type="number" name="stitchin" class="form-control" onchange="myChangeFunction(this)" id="stitchIn" placeholder="Enter Number of Stitches">
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-6">
                        <label>Per Stitch Out x 100</label>
                        <input type="number" name="stitchout" class="form-control" onchange="myChangeFunction(this)" id="stitchOut" placeholder="Enter Number of Stitches">
                        </div>
                        <div class="form-group col-md-6">
                        <label>BSF / BSR</label>
                        <input type="number" name="bsf" class="form-control" id="bsf" placeholder="Enter BSF/BSR Charges - 100"/>
                        </div>
                    </div>
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-6">
                        <label>Short Stay (After One Hour)</label>
                        <input type="number" name="shortstay" onchange="myDayFunction(this)" id="shortStay" placeholder="Enter Short Stay Hours" class="form-control"/>
                        </div>
                        <div class="form-group col-md-6">
                        <label>BP</label>
                        <input type="number" name="bp" class="form-control" onchange="myChangeFunction(this)" id="bp" placeholder="Enter BP Charges - 50">
                        </div>
                    </div>
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-6">
                        <label>ECG</label>
                        <input type="number" class="form-control" name="ecg" id="ecg" placeholder="Enter ECG Charges - 500" />
                        </div>
                        <div class="form-group col-md-6">
                        <label>Other</label>
                        <input type="number" name="other" class="form-control" id="other" placeholder="Enter Other Charges"/>
                        </div>
                    </div>
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-6">
                        <label>Total Bill</label>
                        <input type="number" name="bill" onchange="myDayFunction(this)" id="day" placeholder="Total Bill Displays Here" class="form-control" readonly/>
                        </div>
                        <div class="form-group col-md-6">
                        <label>Discount</label>
                        <input type="number" name="discount" class="form-control" onchange="myChangeFunction(this)" id="discount" placeholder="Discount">
                        </div>
                    </div>

                </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer" style="text-align: right;">
            <button type="submit" name="bill-submit" class="btn btn-block btn-primary">Submit</button>
          </div>
        </div>
        <!-- /.card -->
        </form>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php
    }  
  ?>
  <!-- Main Footer -->
  <?php include('components/footer.php'); ?>
  <!-- /. Main Footer -->
</div>
<!-- ./wrapper -->

<!-- Script Files -->
<?php include('components/form_script.php'); ?>