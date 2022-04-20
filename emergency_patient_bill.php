<?php 
  // Session Start
  session_start();
  if (isset($_SESSION['userid'])) {
  // Get MRID from URL 
  $sid = (isset($_GET['sid']) ? $_GET['sid'] : ''); 
  echo '<script>console.log('.$sid.');</script>';
  // Connection File
  include('backend_components/connection.php');
  // Form Header File
  include('components/form_header.php');
  // Navbar File
  include('components/navbar.php');

  // Save Patient Data Query
  if (isset($_POST['emergency-bill-submit'])) {
    // Post Variables
    $mrid = $_POST['mrid'];
    $phone = $_POST['phone'];
    $name = $_POST['name'];
    $addDate = $_POST['addDate'];
    $medicalofficer = $_POST['medicalofficer'];
    $injectionim = $_POST['injectionim'];
    $injectioniv = $_POST['injectioniv'];
    $ivline = $_POST['ivline'];
    $stitchInTotal = $_POST['stitchInTotal'];

    $stitchOutTotal = $_POST['stitchOutTotal'];
    $ivinfusion = $_POST['ivinfusion'];
    $bsf = $_POST['bsf'];
    $shortstay = $_POST['shortstay'];
    $bp = $_POST['bp'];
    $ecg = $_POST['ecg'];
    $other = $_POST['other'];
    $tbill = $_POST['tbill'];
    $discount = $_POST['discount'];
    $fbill = $_POST['fbill'];
    $by = $_POST['by'];
    $status = "created";

    // Check Data from DB
    $sql = "SELECT * FROM `emergency_bill` WHERE `SLIP_ID` = ?";
    $stmt = mysqli_stmt_init($db);
        
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        echo '<script type="text/javascript">window.location = "emergency_bill.php?action=billAlreadyCreated";</script>';
        exit();
    }else{
        mysqli_stmt_bind_param($stmt,"s",$sid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);

        // Insert Query
        $sql = "INSERT INTO `emergency_bill`
        (
          `MR_ID`,`SLIP_ID`, `PATIENT_NAME`, `MOBILE`, `DATE_TIME`, `ES_MO_CHARGE`, `INJECTION_IM`, `INJECTION_IV`, `IV_LINE`, `IV_INFUSION`, `PS_IN_300`, `PS_OUT_100`, `BSF_BSR`, `SHORT_STAY`, `BP`, `ECG`, `OTHER`, `TOTAL_AMOUNT`, `DISCOUNT`, `TOTAL`, `CREATED_BY`
        ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        mysqli_stmt_execute($stmt);
        
        if (!mysqli_stmt_prepare($stmt,$sql)) {
          echo '<script type="text/javascript">window.location = "emergency_bill.php?action=sqlerror";</script>';
          echo "<script>alert('Sqlerror due to DB Query...');</script>";
          exit();
        }else{                                
          mysqli_stmt_bind_param($stmt,"sssssssssssssssssssss",$mrid,$sid,$name,$phone,$addDate,$medicalofficer,
          $injectionim,$injectioniv,$ivline,$ivinfusion,$stitchInTotal,$stitchOutTotal,$bsf,$shortstay,$bp,$ecg,$other,$tbill,$discount,$fbill,$by);
          mysqli_stmt_execute($stmt);
          // Update Status of the receipt
          $updateSql ="UPDATE `emergency_slip` SET `BILL_STATUS`='$status' WHERE `emergency_slip`.`SLIP_ID`='$sid'";
          if($querySql = mysqli_query($db,$updateSql))
          {
            // echo "<script>alert('Doctor record updated successfully...');window.location = '../doctors.php';</script>";
            echo '<script type="text/javascript">window.location = "emergency_bill_print.php?pname='.$name.'&on='.$addDate.'&mrid='.$mrid.'&phone='.$phone.'&by='.$by.'&mo='.$medicalofficer.'&injectionim='.$injectionim.'&injectioniv='.$injectioniv.'&ivline='.$ivline.'&sin='.$stitchInTotal.'&sout='.$stitchOutTotal.'&ivinfection='.$ivinfusion.'&bsf='.$bsf.'&sstay='.$shortstay.'&bp='.$bp.'&ecg='.$ecg.'&other='.$other.'&tbill='.$tbill.'&disc='.$discount.'&fbill='.$fbill.'";</script>';                                                   
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

  // Sidebar File
  include('components/sidebar.php');

  // Check if MRID is empty or not
  if (!empty($sid)) {
    // include('components/simple_bill_form.php');  
//   } else{
    $sql="SELECT *, `DOCTOR_NAME` FROM `emergency_slip` INNER JOIN `doctor` WHERE `SLIP_ID` = '$sid' AND `emergency_slip`.`DOCTOR_ID` = `doctor`.`DOCTOR_ID`";
    // $sql="SELECT *, `DOCTOR_NAME`  FROM `emergency_slip` INNER JOIN `doctor` WHERE `emergency_slip`.`DOCTOR_ID` = `doctor`.`DOCTOR_ID` AND `emergency_slip`.`SLIP_ID` = '$id'";
    $qsql = mysqli_query($db,$sql);
    $patdata = mysqli_fetch_array($qsql);

    echo '<script>console.log('.$patdata['SLIP_MR_ID'].' | '.$patdata['SLIP_NAME'].' | '.$patdata['SLIP_MOBILE'].' | '.$patdata['SLIP_ID'].');</script>';

?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="card-title p-3"><a href="javascript:history.go(-1)"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;Back</a></h3>
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
                    <input type="text" name="phone" value="<?php echo $patdata['SLIP_MOBILE'] ; ?>" hidden readonly>
                    <input type="text" name="by" value="<?php echo $_SESSION['userid'] ; ?>" hidden readonly>

                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-6">
                        <input type="text" name="addDate" id="addDate" hidden/>
                        <script>var addDate = new Date();document.getElementById('addDate').value = addDate;</script>
                        <label>Patient MR_ID</label>
                        <input type="text" class="form-control" name="mrid" value="<?php echo $patdata['SLIP_MR_ID'] ; ?>" readonly/>
                        </div>
                        <div class="form-group col-md-6">
                        <label>Patient Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $patdata['SLIP_NAME'] ; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-6">
                        <label>Emergency Slip / Medical Officer</label>
                        <input type="number" name="medicalofficer" id="moCharge" placeholder="General Charges is 500" class="form-control"/>
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
                        <label>Per Stitch In x 300</label>
                        <div style="display:flex;">
                          <input type="number" style="width:60%;" name="stitchin" class="form-control" id="stitchIn" onchange="getStitchInTotal()" placeholder="No# of Stitches">
                          <input type="number" style="width:40%;" name="stitchInTotal" class="form-control" id="stitchInTotal" placeholder="Amount" readonly/>
                        </div>
                        <script>
                            function getStitchInTotal(){
                              var stitchIn = document.getElementById("stitchIn").value;
                              document.getElementById("stitchInTotal").value = stitchIn*300;
                            }
                        </script>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Per Stitch Out x 100</label>
                          <div style="display:flex;">
                            <input type="number" style="width:60%;"  name="stitchout" class="form-control" id="stitchOut" onchange="getStitchOutTotal()" placeholder="No# of Stitches">
                            <input type="number" style="width:40%;" name="stitchOutTotal" class="form-control" id="stitchOutTotal" placeholder="Amount" readonly/>
                          </div>
                          <script>
                            function getStitchOutTotal(){
                              var stitchOut = document.getElementById("stitchOut").value;
                              document.getElementById("stitchOutTotal").value = stitchOut*100;
                            }
                        </script>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-6">
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
                        <label>BSF / BSR</label>
                        <input type="number" name="bsf" class="form-control" id="bsf" placeholder="Enter BSF/BSR Charges - 100"/>
                        </div>
                    </div>
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-6">
                        <label>Short Stay (After One Hour)</label>
                        <input type="number" name="shortstay" id="shortStay" placeholder="Enter Short Stay Hours" class="form-control"/>
                        </div>
                        <div class="form-group col-md-6">
                        <label>BP</label>
                        <input type="number" name="bp" class="form-control" id="bp" placeholder="Enter BP Charges - 50">
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
            <button type="submit" name="emergency-bill-submit" class="btn btn-block btn-primary">Submit</button>
          </div>
        </div>
        <!-- /.card -->
        </form>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<!-- **
    *  Function to calculate the total amount  and discount calculate function
    ** -->
<script>
  function calculateTotal() {
      var moCharge = document.getElementById("moCharge").value;
      var injectionIM = document.getElementById("injectionIM").value;
      var injectionIV = document.getElementById("injectionIV").value;
      var ivLine = document.getElementById("ivLine").value;
      var ivInfusion = document.getElementById("ivInfusion").value;
      var stitchInTotal = document.getElementById("stitchInTotal").value;
      var stitchOutTotal = document.getElementById("stitchOutTotal").value;
      var ivInfusion = document.getElementById("ivInfusion").value;
      var bsf = document.getElementById("bsf").value;
      var shortStay = document.getElementById("shortStay").value;
      var bp = document.getElementById("bp").value;
      var ecg = document.getElementById("ecg").value;
      var other = document.getElementById("other").value;
      var totalBill = +moCharge + +injectionIM + +injectionIV+ +ivLine + +ivInfusion + +stitchInTotal+ +stitchOutTotal + +bsf+ +shortStay + +bp + +ecg+ +other;
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
  // Footer File
  include('components/footer.php');
  echo '</div>';
  // Form Script File
  include('components/form_script.php');

}else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
} 
?>