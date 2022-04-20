<?php 
  // Session Start
  session_start();
  if (isset($_SESSION['userid'])) {
  // Get MRID and Type from URL  
  $sid = (isset($_GET['sid']) ? $_GET['sid'] : ''); 
//   $type = (isset($_GET['type']) ? $_GET['type'] : '');
  // Connection File
  include('backend_components/connection.php'); 
    // Form Header File
  include('components/form_header.php'); 
    // Navbar File
  include('components/navbar.php'); 
  
  // Save Patient Data Query 
  if (isset($_POST['indoor-bill-submit'])) {
    // Post Variables from Form
    $mrid = $_POST['mrid'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $type = $_POST['type'];

    // $age = $_POST['age'];
    // $gender = $_POST['gender'];
    // $add = $_POST['address'];
    $doc = $_POST['doctor'];
    $pro = $_POST['procedure'];

    $admdate = $_POST['admdate'];
    $disdate = $_POST['disdate'];
    // $admitdays = $_POST['admitdays'];
    // $addDate = $_POST['disdate']; 

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
    $status = "created";

    // Query to check if data exists 
    $sql = "SELECT * FROM `indoor_bill` WHERE `SLIP_ID` = ?";
    $stmt = mysqli_stmt_init($db);
          
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        echo '<script type="text/javascript">window.location = "indoor_bill.php?action=billAlreadyCreated";</script>';
        exit();
    }else{
        mysqli_stmt_bind_param($stmt,"s",$sid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);

        $sql = "INSERT INTO `indoor_bill`(
          `MR_ID`,
          `SLIP_ID`,
          `PATIENT_NAME`,
          `MOBILE`,
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
            echo '<script type="text/javascript">window.location = "indoor_bill.php?action=sqlerror";</script>';
            echo "<script>alert('Sqlerror due to DB Query...');</script>";
            exit();
        }else{                                
            mysqli_stmt_bind_param($stmt,"sssssssssssssssssssssssss",
            $mrid,$sid,$name,$phone,$admdate,$disdate,$disdate,$adCharge,$surCharge,$anesCharge,
            $opCharge,$chargeLR,$pedCharge,
            $prChargeThree,$nurCharge,$nurStCharge,$moCharge,$conCharge,$ctg,$rrCharge,
            $other,$tbill,$discount,$fbill,$by);
            mysqli_stmt_execute($stmt);
            // Update Status of the receipt
            $updateSql ="UPDATE `indoor_slip` SET `BILL_STATUS`='$status' WHERE `indoor_slip`.`SLIP_ID`='$sid'";
            if($querySql = mysqli_query($db,$updateSql))
            {
              echo '<script type="text/javascript">window.location = "indoor_bill_print.php?pname='.$name.'&mrid='.$mrid.'&phone='.$phone.'&type='.$type.'&admdate='.$admdate.'&disdate='.$disdate.'&doc='.$doc.'&pro='.$pro.'&adcharge='.$adCharge.'&surcharge='.$surCharge.'&anescharge='.$anesCharge.'&opcharge='.$opCharge.'&chargelr='.$chargeLR.'&pedcharge='.$pedCharge.'&prcharge='.$prChargeThree.'&nurcharge='.$nurCharge.'&nurstcharge='.$nurStCharge.'&mocharge='.$moCharge.'&concharge='.$conCharge.'&ctg='.$ctg.'&rrcharge='.$rrCharge.'&other='.$other.'&type='.$type.'&tbill='.$tbill.'&dis='.$discount.'&fbill='.$fbill.'&by='.$by.'";</script>';                                                   
            }else
            {
              echo mysqli_error($db);
            }  
              exit();
          }			
      }
      mysqli_stmt_close($stmt);
      mysqli_close($db);
    }

  // Main Sidebar Container
  include('components/sidebar.php'); 
  
  //Check if MRID is empty or not 
  if (!empty($sid)) {
    // include('components/simple_bill_form.php');  
//   } else {
    $sql="SELECT *, `DOCTOR_NAME` FROM `indoor_slip` INNER JOIN `doctor` WHERE `SLIP_ID` = '$sid' AND `indoor_slip`.`DOCTOR_ID` = `doctor`.`DOCTOR_ID`";
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
                    <!-- <input type="text" name="age" value="<?php //echo $patdata['PATIENT_AGE'] ; ?>" hidden readonly> -->
                    <input type="text" name="admdate" id="slipDate" value="<?php echo $patdata['SLIP_DATE_TIME'] ; ?>" hidden readonly>
                    <input type="text" name="doctor" value="<?php echo $patdata['DOCTOR_NAME'] ; ?>" hidden readonly>
                    <input type="text" name="procedure" value="<?php echo $patdata['SLIP_PROCEDURE'] ; ?>" hidden readonly>
                    <input type="text" name="type" value="<?php echo $patdata['SLIP_TYPE'] ; ?>" hidden readonly>
                    <input type="text" name="disdate" id="disdate" hidden/>
                    <script>
                        let disDate = new Date();
                        document.getElementById('disdate').value = disDate;
                    </script>
    
                    <input type="text" name="by" value="<?php echo $_SESSION['userid'] ; ?>" hidden readonly>

                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-3">
                            <label>Patient MR_ID</label>
                            <input type="text" class="form-control" name="mrid" value="<?php echo $patdata['SLIP_MR_ID'] ; ?>" readonly/>
                        </div>
                        <div class="form-group col-md-5">
                            <label>Patient Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $patdata['SLIP_NAME'] ; ?>" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Patient Mobile</label>
                            <input type="text" class="form-control" name="phone" value="<?php echo $patdata['SLIP_MOBILE'] ; ?>" readonly/>
                        </div>
                    </div>
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-4">
                            <label>Admission Charges</label>
                            <input type="number" name="adCharge" id="adCharge" placeholder="Rate is 2000" class="form-control"/>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Surgeon Charges</label>
                            <input type="number" name="surCharge" class="form-control" id="surCharge" placeholder="Rates Varies">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Anesthetist Charges</label>
                            <input type="number" class="form-control" name="anesCharge" id="anesCharge" placeholder="Rates Varies"/>
                        </div>
                    </div>
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                      <div class="form-group col-md-4">
                        <label>Pediatric Charges</label>
                          <div style="display:flex;">
                            <input type="number" name="pedCharge" class="form-control" id="pedCharge" placeholder="Rate Varies">
                          </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>M O Charges</label>
                            <input type="number" name="moCharge" id="moCharge" placeholder="Rate is 2000" class="form-control"/>
                        </div>
                        <div class="form-group col-md-4">
                            <label>CTG Charges</label>
                            <input type="number" class="form-control" name="ctg" id="ctg" placeholder="Rate is 2,000" />
                        </div>
                    </div>
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-4">
                            <label>Operation Charges</label>
                            <input type="number" name="opCharge" class="form-control" id="opCharge" placeholder="Rate is 10,000"/>
                        </div>
                        <div class="form-group col-md-5">
                            <label>Labour Room Charges</label>
                            <div style="display:flex;">
                                <input type="number" name="chargeLR" class="form-control" id="chargeLR" placeholder="Rate is 8,000">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Other</label>
                            <input type="number" name="other" class="form-control" id="other" placeholder="Charges"/>
                        </div>
                    </div>

                </div>
                
                <!-- /.col -->
                <div class="col-md-6">

                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-6">
                            <label>Nursury Charges</label>
                            <input type="number" name="nurCharge" id="nurCharge" placeholder="Rate is 8,000" class="form-control"/>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nursury Staff Charges</label>
                            <input type="number" name="nurStCharge" class="form-control" id="nurStCharge" placeholder="Rate is 1500"/>
                        </div>
                    </div>
            
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-6">
                            <label>Consultant Visit Charges</label>
                            <input type="number" name="conCharge" class="form-control" id="conCharge" placeholder="Rates May Varies">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Recovery Room Charges</label>
                            <input type="number" class="form-control" name="rrCharge" id="rrCharge" placeholder="Rate is 5,000" />
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Private Room Charges</label>
                        <div style="display:flex;">
                            <select class="form-control select2bs4"  style="width:50%;" name="prChargeOne" id="prChargeOne" onchange="getPrTotal()" style="width: 100%;">
                                <option selected="selected" disabled>Select Private Room Charges</option>
                                <?php
                                $room = 'SELECT `ROOM_ID`, `ROOM_NAME`,`ROOM_RATE` FROM `room` WHERE `ROOM_STATUS` = "active"';
                                $result = mysqli_query($db, $room) or die (mysqli_error($db));
                                    while ($row = mysqli_fetch_array($result)) {
                                    $id = $row['ROOM_RATE'];  
                                    $name = $row['ROOM_NAME'];
                                    echo '<option value="'.$id.'">'.$name.'</option>'; 
                                }
                                ?>
                            </select> 
                            <input type="number" style="width:20%;" name="prChargeTwo" class="form-control" id="prChargeTwo" value="1" onchange="getPrTotal()" placeholder="No. of Days"/>
                            <input type="number" style="width:30%;" name="prChargeThree" class="form-control" id="prChargeThree"  placeholder="Total Charges" readonly/>
                          </div>
                    </div>
                    <script>
                        function getPrTotal(){
                          var prChargeOne = document.getElementById("prChargeOne").value;
                          var prChargeTwo = document.getElementById("prChargeTwo").value;
                          document.getElementById("prChargeThree").value = prChargeOne*prChargeTwo;
                        }
                    </script>
                   
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-6">
                          <label>Total Bill</label>
                            <div class="input-group mb-3">
                              <input type="number" name="tbill" id="totalBill" placeholder="Total Bill" class="form-control" readonly/>
                              <span class="input-group-append">
                                <button type="button" onclick="calculateTotal();" class="btn btn-block btn-primary">calculate</button>
                              </span>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Discount</label>
                            <input type="number" name="discount"  onchange="discFunction(this)" class="form-control" id="discount" placeholder="Discount">
                        </div>
                        <div class="form-group col-md-3">
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
  <!-- Function to calculate total amount and discount of the bill -->
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

<?php
  }  
 //  Footer File
 include('components/footer.php'); 
 
 echo '</div>';
 // Form Script File 
 include('components/form_script.php'); 
}else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
}
?>