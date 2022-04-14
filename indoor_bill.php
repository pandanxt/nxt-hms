<?php 
  session_start(); 
  $mrid = (isset($_GET['mrid']) ? $_GET['mrid'] : ''); 
  $type = (isset($_GET['type']) ? $_GET['type'] : '');
?>
<!-- Header Form -->
  <?php include('backend_components/connection.php'); ?>
  <!-- Header Files -->
  <?php include('components/form_header.php'); ?>
  <!-- Navbar -->
  <?php include('components/navbar.php'); ?>
  <!-- /.navbar -->

  <!-- Save Patient Data Query -->
  <?php
    if (isset($_POST['indoor-bill-submit'])) {
     
      $mrid = $_POST['mrid'];
      $name = $_POST['name'];
      $phone = $_POST['phone'];
      $cnic = $_POST['cnic'];

      $age = $_POST['age'];
      $gender = $_POST['gender'];
      $add = $_POST['address'];
      $doc = $_POST['doctor'];
      $pro = $_POST['procedure'];

      $admdate = $_POST['admdate'];
      $disdate = $_POST['disdate'];
      $addDate = $_POST['addDate'];

      $adCharge = $_POST['adCharge'];
      $surCharge = $_POST['surCharge'];
      $anesCharge = $_POST['anesCharge'];
      $opCharge = $_POST['opCharge'];
      $chargeLR = $_POST['chargeLR'];
      $pedCharge = $_POST['pedCharge'];
      $prChargeThree = $_POST['prChargeThree'];
      $nurCharge = $_POST['nurCharge'];
      $nurStCharge = $_POST['nurStCharge'];
      $moCharge = $_POST['moCharge'];
      $conCharge = $_POST['conCharge'];
      $ctg = $_POST['ctg'];
      $rrCharge = $_POST['rrCharge'];
      $other = $_POST['other'];
      $tbill = $_POST['tbill'];
      $discount = $_POST['discount'];
      $fbill = $_POST['fbill'];
      $by = $_POST['by'];


          $sql = "SELECT * FROM `indoor_bill` WHERE `MR_ID` = ?";
          $stmt = mysqli_stmt_init($db);
          
          if (!mysqli_stmt_prepare($stmt,$sql)) {
              // header("Location: ../add_bill.php?action=sqlerror");
              echo '<script type="text/javascript">window.location = "indoor_bill.php?action=sqlerror";</script>';
              exit();
          }else{
              mysqli_stmt_bind_param($stmt,"s",$mrid);
              mysqli_stmt_execute($stmt);
              mysqli_stmt_store_result($stmt);
              $resultCheck = mysqli_stmt_num_rows($stmt);

              $sql = "INSERT INTO `indoor_bill`(
                `MR_ID`,
                 `PATIENT_NAME`,
                  `MOBILE`,
                   `CNIC`,
                    `ADMISSION_DATE`,
                     `DISCHARGE_DATE`,
                      `DATE_TIME`,
                       `ADMISSION_CHARGE`,
                        `SURGEON_CHARGE`,
                         `ANESTHETIST_CHARGE`,
                          `OPERATION_CHARGE`,
                           `LABOUR_ROOM_CHARGE`,
                            `PEDIATRIC_CHARGE`,
                             `PRIVATE_ROOM_CHARGE`,
                              `NURSURY_CHARGE`,
                               `NURSURY_STAFF_CHARGE`,
                                `MO_CHARGE`,
                                 `CONSULTANT_CHARGE`,
                                  `CTG_CHARGE`,
                                   `RECOVERY_ROOM_CHARGE`,
                                    `OTHER`,
                                     `TOTAL_AMOUNT`,
                                      `DISCOUNT`,
                                       `TOTAL`,
                                        `CREATED_BY`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
              mysqli_stmt_execute($stmt);
          
              if (!mysqli_stmt_prepare($stmt,$sql)) {
                  // header("Location: ../emergency_bill.php?error=sqlerror");
                  echo '<script type="text/javascript">window.location = "indoor_bill.php?action=sqlerror";</script>';
                  echo "<script>alert('Sqlerror due to DB Query...');</script>";
                  exit();
              }else{                                
                      mysqli_stmt_bind_param($stmt,"sssssssssssssssssssssssss",
                      $mrid,$name,$phone,$cnic,$admdate,$disdate,$addDate,$adCharge,$surCharge,$anesCharge,
                      $opCharge,$chargeLR,$pedCharge,
                      $prChargeThree,$nurCharge,$nurStCharge,$moCharge,$conCharge,$ctg,$rrCharge,
                      $other,$tbill,$discount,$fbill,$by);
                      mysqli_stmt_execute($stmt);
                      // echo '<script type="text/javascript">window.location = "../emergency_bill.php?action=saved";</script>';							
                      echo '<script type="text/javascript">window.location = "indoor_slip_print.php?pname='.$name.'&mrid='.$mrid.'&phone='.$phone.'&cnic='.$cnic.'&age='.$age.'&gender='.$gender.'&add='.$add.'&doc='.$doc.'&pro='.$pro.'&adm='.$admdate.'&dis='.$disdate.'&adddate='.$addDate.'&adcharge='.$adCharge.'&surcharge='.$surCharge.'&anescharge='.$anesCharge.'&opcharge='.$opCharge.'&chargelr='.$chargeLR.'&pedcharge='.$pedCharge.'&prcharge='.$prChargeThree.'&nurcharge='.$nurCharge.'&nurstcharge='.$nurStCharge.'&mocharge='.$moCharge.'&concharge='.$conCharge.'&ctg='.$ctg.'&rrcharge='.$rrCharge.'&other='.$other.'&type='.$type.'&tbill='.$tbill.'&dis='.$discount.'&fbill='.$fbill.'&by='.$by.'";</script>';                                                   
                      exit();
                  }			
              }
      mysqli_stmt_close($stmt);
      mysqli_close($db);
  }
  ?>

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
      $sql="SELECT *, `DOCTOR_NAME` FROM `indoor_patient` INNER JOIN `doctor` WHERE `PATIENT_MR_ID` = '$mrid' AND `indoor_patient`.`DOCTOR_ID` = `doctor`.`DOCTOR_ID`";
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
          <form action="" method="post" enctype="multipart/form-data">
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="age" value="<?php echo $patdata['PATIENT_AGE'] ; ?>" hidden readonly>
                    <input type="text" name="gender" value="<?php echo $patdata['PATIENT_GENDER'] ; ?>" hidden readonly>
                    <input type="text" name="doctor" value="<?php echo $patdata['DOCTOR_NAME'] ; ?>" hidden readonly>
                    <input type="text" name="procedure" value="<?php echo $patdata['PATIENT_PROCEDURE'] ; ?>" hidden readonly>
                    <input type="text" name="address" value="<?php echo $patdata['PATIENT_ADDRESS'] ; ?>" hidden readonly>
    
                    <input type="text" name="by" value="<?php echo $_SESSION['userid'] ; ?>" hidden readonly>

                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-6">
                        <input type="text" name="addDate" id="addDate" hidden/>
                        <script>var addDate = new Date();document.getElementById('addDate').value = addDate;</script>
                        <label>Patient MR_ID</label>
                        <input type="text" class="form-control" name="mrid" value="<?php echo $patdata['PATIENT_MR_ID'] ; ?>" readonly/>
                        </div>
                        <div class="form-group col-md-6">
                        <label>Patient Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $patdata['PATIENT_NAME'] ; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-6">
                        <label>Admission Charges</label>
                        <input type="number" name="adCharge" id="adCharge" placeholder="Admission Charges is 2000" class="form-control"/>
                        </div>
                        <div class="form-group col-md-6">
                        <label>Surgeon Charges</label>
                        <input type="number" name="surCharge" class="form-control" id="surCharge" placeholder="Surgery Rates Varies">
                        </div>
                    </div>
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-6">
                        <label>Anesthetist Charges</label>
                        <input type="number" class="form-control" name="anesCharge" id="anesCharge" placeholder="Anesthetist Rates Varies"/>
                        </div>
                        <div class="form-group col-md-6">
                        <label>Operation Charges</label>
                        <input type="number" name="opCharge" class="form-control" id="opCharge" placeholder="Operation Charges is 10,000"/>
                        </div>
                    </div>
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-6">
                        <label>Labour Room Charges</label>
                        <div style="display:flex;">
                        <input type="number" name="chargeLR" class="form-control" id="chargeLR" placeholder="Labour Room Rate is 8,000">
                        </div>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Pediatric Charges</label>
                          <div style="display:flex;">
                          <input type="number" name="pedCharge" class="form-control" id="pedCharge" placeholder="Pediatric Rate Varies">
                          </div>
                        </div>
                    </div>
                      <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-6">
                          <label>Admission Date</label>
                          <div class="input-group date" id="admissiondatetime" data-target-input="nearest">
                              <input type="text" name="admdate" class="form-control datetimepicker-input" data-target="#admissiondatetime"/>
                              <div class="input-group-append" data-target="#admissiondatetime" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                        </div>
                        <div class="form-group col-md-6">
                          <label>Discharge Date</label>
                          <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                              <input type="text" name="disdate" class="form-control datetimepicker-input" data-target="#reservationdatetime"/>
                              <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                        </div>
                      </div>
                    <div class="form-group col-md-12">
                        <label>Private Room Charges</label>
                        <div style="display:flex;">
                            <select class="form-control select2bs4"  style="width:60%;" name="prChargeOne" id="prChargeOne" onchange="getPrTotal()" style="width: 100%;">
                              <option selected="selected" disabled>Select Private Room Charges</option>
                              <option value="5000">Semi Pvt Ward Charges - 5000</option>
                              <option value="8000">Pvt Room Charges - 8000</option>
                              <option value="10000">VIP Room Charges - 10000</option>
                            </select>  
                            <input type="number" style="width:20%;" name="prChargeTwo" class="form-control" id="prChargeTwo" value="1" onchange="getPrTotal()" placeholder="No. of Days"/>
                            <input type="number" style="width:20%;" name="prChargeThree" class="form-control" id="prChargeThree"  placeholder="Total Charges" readonly/>
                          </div>
                    </div>
                    <script>
                        function getPrTotal(){
                          var prChargeOne = document.getElementById("prChargeOne").value;
                          var prChargeTwo = document.getElementById("prChargeTwo").value;
                          document.getElementById("prChargeThree").value = prChargeOne*prChargeTwo;
                        }
                    </script>
                </div>
                <!-- /.col -->
                <div class="col-md-6">

                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-6">
                        <label>Mobile</label>
                        <input type="text" class="form-control" name="phone" value="<?php echo $patdata['PATIENT_MOBILE'] ; ?>" readonly/>
                        </div>
                        <div class="form-group col-md-6">
                        <label>CNIC</label>
                        <input type="text" name="cnic" class="form-control" value="<?php echo $patdata['PATIENT_CNIC'] ; ?>" readonly>
                        </div>
                    </div>

                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-6">
                        <label>Nursury Charges</label>
                        <input type="number" name="nurCharge" id="nurCharge" placeholder="Nursury Rate is 8,000" class="form-control"/>
                        </div>
                        <div class="form-group col-md-6">
                        <label>Nursury Staff Charges</label>
                        <input type="number" name="nurStCharge" class="form-control" id="nurStCharge" placeholder="Nursery Staff Rate is 1500"/>
                        </div>
                    </div>
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-6">
                        <label>M O Charges</label>
                        <input type="number" name="moCharge" id="moCharge" placeholder="M O Rate is 2000" class="form-control"/>
                        </div>
                        <div class="form-group col-md-6">
                        <label>Consultant Visit Charges</label>
                        <input type="number" name="conCharge" class="form-control" id="conCharge" placeholder="Consultant Charges May Varies">
                        </div>
                    </div>
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-6">
                        <label>CTG Charges</label>
                        <input type="number" class="form-control" name="ctg" id="ctg" placeholder="CTG Rate is 2,000" />
                        </div>
                        <div class="form-group col-md-6">
                        <label>Recovery Room Charges</label>
                        <input type="number" class="form-control" name="rrCharge" id="rrCharge" placeholder="Recovery Room Rate is 5,000" />
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Other</label>
                        <input type="number" name="other" class="form-control" id="other" placeholder="Enter Other Charges"/>
                    </div>
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-4">
                          <label>Total Bill</label>
                            <div class="input-group mb-3">
                              <input type="number" name="tbill" id="totalBill" placeholder="Total Bill" class="form-control" readonly/>
                              <span class="input-group-append">
                                <button type="button" onclick="calculateTotal();" class="btn btn-block btn-primary">calculate</button>
                              </span>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                        <label>Discount</label>
                        <input type="number" name="discount"  onchange="discFunction(this)" class="form-control" id="discount" placeholder="Discount">
                        </div>
                        <div class="form-group col-md-4">
                        <label>Final Bill</label>
                        <input type="number" name="fbill" id="finalBill" placeholder="Final Bill" class="form-control" readonly/>
                        </div>
                    </div>

                </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer" style="text-align: right;">
            <button type="submit" name="indoor-bill-submit" class="btn btn-block btn-primary">Submit</button>
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

<script>
    function calculateTotal() {
        var adCharge = document.getElementById("adCharge").value;
        var surCharge = document.getElementById("surCharge").value;
        var anesCharge = document.getElementById("anesCharge").value;
        var opCharge = document.getElementById("opCharge").value;
        var chargeLR = document.getElementById("chargeLR").value;
        var pedCharge = document.getElementById("pedCharge").value;
        var prChargeThree = document.getElementById("prChargeThree").value;
        var nurCharge = document.getElementById("nurCharge").value;
        var nurStCharge = document.getElementById("nurStCharge").value;
        var moCharge = document.getElementById("moCharge").value;
        var conCharge = document.getElementById("conCharge").value;
        var ctg = document.getElementById("ctg").value;
        var rrCharge = document.getElementById("rrCharge").value;
        var other = document.getElementById("other").value;
        var totalBill = +adCharge + +surCharge + +anesCharge+ +opCharge + +chargeLR + +pedCharge+ +prChargeThree + +nurCharge+ +nurStCharge + +moCharge+ +conCharge+ +ctg+ +rrCharge+ +other;
        document.getElementById("totalBill").value = totalBill;
        console.log("this is the total result:" ,totalBill);
    }

        function discFunction(discount) {
          var finalBill = document.getElementById('finalBill');
          var totalBill = document.getElementById('totalBill');
          finalBill.value = totalBill.value - discount.value;
          console.log("this is the final result:" ,finalBill.value);
        }

</script>

  <!-- Main Footer -->
  <?php include('components/footer.php'); ?>
  <!-- /. Main Footer -->
</div>
<!-- ./wrapper -->

<!-- Script Files -->
<?php include('components/form_script.php'); ?>