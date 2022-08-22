<?php 
  // Session Start
  session_start();
  if (isset($_SESSION['userid'])) {
  // Get MRID from URL 
  $sid = (isset($_GET['sid']) ? $_GET['sid'] : ''); 
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
    // $addDate = $_POST['addDate'];
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

    $other1 = $_POST['other1'];
    $otherText1 = $_POST['otherText1'];
    $other2 = $_POST['other2'];
    $otherText2 = $_POST['otherText2'];
    $other3 = $_POST['other3'];
    $otherText3 = $_POST['otherText3'];
    $other4 = $_POST['other4'];
    $otherText4 = $_POST['otherText4'];
    $other5 = $_POST['other5'];
    $otherText5 = $_POST['otherText5'];
    $other6 = $_POST['other6'];
    $otherText6 = $_POST['otherText6'];
    $other7 = $_POST['other7'];
    $otherText7 = $_POST['otherText7'];
    $other8 = $_POST['other8'];
    $otherText8 = $_POST['otherText8'];
    $other9 = $_POST['other9'];
    $otherText9 = $_POST['otherText9'];
    $other10 = $_POST['other10'];
    $otherText10 = $_POST['otherText10'];
    $other11 = $_POST['other11'];
    $otherText11 = $_POST['otherText11'];
    $other12 = $_POST['other12'];
    $otherText12 = $_POST['otherText12'];
    
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
          `MR_ID`,`SLIP_ID`, 
          `PATIENT_NAME`, 
          `MOBILE`,
          `ES_MO_CHARGE`, 
          `INJECTION_IM`, 
          `INJECTION_IV`, 
          `IV_LINE`, 
          `IV_INFUSION`, 
          `PS_IN_300`, 
          `PS_OUT_100`, 
          `BSF_BSR`, 
          `SHORT_STAY`, 
          `BP`, 
          `ECG`,
          `OTHER_1`, 
          `OTHER_TEXT_1`, 
          `OTHER_2`, 
          `OTHER_TEXT_2`,
          `OTHER_3`, 
          `OTHER_TEXT_3`,
          `OTHER_4`, 
          `OTHER_TEXT_4`,
          `OTHER_5`, 
          `OTHER_TEXT_5`,
          `OTHER_6`, 
          `OTHER_TEXT_6`,
          `OTHER_7`, 
          `OTHER_TEXT_7`,
          `OTHER_8`, 
          `OTHER_TEXT_8`,
          `OTHER_9`, 
          `OTHER_TEXT_9`,
          `OTHER_10`, 
          `OTHER_TEXT_10`,
          `OTHER_11`, 
          `OTHER_TEXT_11`,
          `OTHER_12`, 
          `OTHER_TEXT_12`,
          `TOTAL_AMOUNT`, 
          `DISCOUNT`, 
          `TOTAL`, 
          `CREATED_BY`
        ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        // mysqli_stmt_execute($stmt);
        
        if (!mysqli_stmt_prepare($stmt,$sql)) {
          echo '<script type="text/javascript">window.location = "emergency_bill.php?action=sqlerror";</script>';
          echo "<script>alert('Sqlerror due to DB Query...');</script>";
          exit();
        }else{                                
          mysqli_stmt_bind_param($stmt,"sssssssssssssssssssssssssssssssssssssssssss",$mrid,$sid,$name,$phone,$medicalofficer,$injectionim,$injectioniv,$ivline,$ivinfusion,$stitchInTotal,$stitchOutTotal,$bsf,$shortstay,$bp,$ecg, $other1, $otherText1, $other2, $otherText2, $other3, $otherText3, $other4, $otherText4, $other5, $otherText5, $other6,  $otherText6, $other7, $otherText7, $other8, $otherText8, $other9, $otherText9, $other10, $otherText10, $other11, $otherText11, $other12, $otherText12,$tbill,$discount,$fbill,$by);
          mysqli_stmt_execute($stmt);
          // Update Status of the receipt
          $updateSql ="UPDATE `emergency_slip` SET `BILL_STATUS`='$status' WHERE `emergency_slip`.`SLIP_ID`='$sid'";
          if($querySql = mysqli_query($db,$updateSql))
          {
            $printQuery = "SELECT `BILL_ID` FROM `emergency_bill` ORDER BY `BILL_ID` DESC LIMIT 1";
            $printsql = mysqli_query($db, $printQuery) or die (mysqli_error($db));
            $pResult = mysqli_fetch_array($printsql);

            if ($pResult > 0) {
              echo '<script type="text/javascript">window.location = "emergency_bill_print.php?sid='.$pResult['BILL_ID'].'";</script>';
            }
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
    $sql="SELECT * FROM `emergency_slip` WHERE `SLIP_ID` = '$sid'";
    $qsql = mysqli_query($db,$sql);
    $patdata = mysqli_fetch_array($qsql);

    echo '<script>console.log('.$patdata['SLIP_MR_ID'].' | '.$patdata['SLIP_NAME'].' | '.$patdata['SLIP_MOBILE'].' | '.$patdata['SLIP_ID'].');</script>';

?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"></section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
    
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"><i class="nav-icon fas fa-hospital-user"></i> Emergency Patient Bill</h3>

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
                        <div class="form-group col-md-4">
                        <label>ER Slip / MO Charges</label>
                        <input type="number" name="medicalofficer" id="moCharge" placeholder="Charges-500" class="form-control"/>
                        </div>
                        <div class="form-group col-md-4">
                        <label>Injection I/M</label>
                        <input type="number" name="injectionim" class="form-control" id="injectionIM" placeholder="Charges-100">
                        </div>
                        <div class="form-group col-md-4">
                        <label>I/V Line (In/Out)</label>
                        <select class="form-control select2bs4" name="ivline" id="ivLine" style="width: 100%;">
                          <option value="0" selected="selected">I/V Line (In/Out)</option>
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
                    <!-- OTher Fields -->
                      <div class="card card-default">
                        <div class="card-header">
                          <h3 class="card-title">Add More Fields</h3>

                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#multiFieldLeft" aria-expanded="false" aria-controls="multiFieldLeft">
                              <i class="fas fa-plus"></i>
                            </button>
                          </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body collapse multi-collapse" id="multiFieldLeft">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                  <!-- <label>Other One</label> -->
                                  <div class="input-group mb-3">
                                    <input type="text" name="otherText1" class="form-control" id="otherText1" placeholder="Description" style="width:65%;"/>
                                      <input type="number" name="other1" id="other1" placeholder="Charges" class="form-control" style="width:35%;"/>
                                  </div>
                              </div>
                              <!-- /.form-group -->
                              <div class="form-group">
                                <!-- <label>Other Two</label> -->
                                <div class="input-group mb-3">
                                  <input type="text" name="otherText2" class="form-control" id="otherText2" placeholder="Description" style="width:65%;"/>
                                    <input type="number" name="other2" id="other2" placeholder="Charges" class="form-control" style="width:35%;"/>
                                </div>
                              </div>
                              <!-- /.form-group -->
                              <div class="form-group">
                                  <!-- <label>Other Three</label> -->
                                  <div class="input-group mb-3">
                                    <input type="text" name="otherText3" class="form-control" id="otherText3" placeholder="Description" style="width:65%;"/>
                                      <input type="number" name="other3" id="other3" placeholder="Charges" class="form-control" style="width:35%;"/>
                                  </div>
                              </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                              <div class="form-group">
                                  <!-- <label>Other Four</label> -->
                                  <div class="input-group mb-3">
                                    <input type="text" name="otherText4" class="form-control" id="otherText4" placeholder="Description" style="width:65%;"/>
                                      <input type="number" name="other4" id="other4" placeholder="Charges" class="form-control" style="width:35%;"/>
                                  </div>
                              </div>
                              <div class="form-group">
                                <!-- <label>Other Five</label> -->
                                <div class="input-group mb-3">
                                  <input type="text" name="otherText5" class="form-control" id="otherText5" placeholder="Description" style="width:65%;"/>
                                    <input type="number" name="other5" id="other5" placeholder="Charges" class="form-control" style="width:35%;"/>
                                </div>
                              </div>
                              <!-- /.form-group -->
                              <div class="form-group">
                                <!-- <label>Other Six</label> -->
                                <div class="input-group mb-3">
                                  <input type="text" name="otherText6" class="form-control" id="otherText6" placeholder="Description" style="width:65%;"/>
                                    <input type="number" name="other6" id="other6" placeholder="Charges" class="form-control" style="width:35%;"/>
                                </div>
                              </div>
                              <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->
                        </div>
                      </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                      <div class="form-group col-md-4">
                        <label>I/V infusion</label>
                        <select class="form-control select2bs4" name="ivinfusion" id="ivInfusion" style="width: 100%;">
                          <option value="0" selected="selected">100ml/200ml/1000ml</option>
                          <option value="200">100ml - 200</option>
                          <option value="500">200ml - 500</option>
                          <option value="1000">1000ml - 1000</option>
                        </select>
                        </div>
                        <div class="form-group col-md-4">
                        <label>BSF / BSR</label>
                        <input type="number" name="bsf" class="form-control" id="bsf" placeholder="Charges-100"/>
                        </div>
                        <div class="form-group col-md-4">
                        <label>Injection I/V</label>
                        <input type="number" class="form-control" name="injectioniv" id="injectionIV" placeholder="Charges-200"/>
                        </div>
                      </div>
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-5">
                        <label>Short Stay (After One Hour)</label>
                        <input type="number" name="shortstay" id="shortStay" placeholder="Enter Short Stay Hours" class="form-control"/>
                        </div>
                        <div class="form-group col-md-4">
                        <label>BP</label>
                        <input type="number" name="bp" class="form-control" id="bp" placeholder="Charges-50">
                        </div>
                        <div class="form-group col-md-3">
                        <label>ECG</label>
                        <input type="number" class="form-control" name="ecg" id="ecg" placeholder="Charges-500" />
                        </div>
                    </div>
                 
                      <!-- OTher Fields -->
                      <div class="card card-default">
                        <div class="card-header">
                          <h3 class="card-title">Add More Fields</h3>

                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#multiFieldRight" aria-expanded="false" aria-controls="multiFieldRight">
                              <i class="fas fa-plus"></i>
                            </button>
                          </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body collapse multi-collapse" id="multiFieldRight">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                  <!-- <label>Other One</label> -->
                                  <div class="input-group mb-3">
                                    <input type="text" name="otherText7" class="form-control" id="otherText7" placeholder="Description" style="width:65%;"/>
                                      <input type="number" name="other7" id="other7" placeholder="Charges" class="form-control" style="width:35%;"/>
                                  </div>
                              </div>
                              <!-- /.form-group -->
                              <div class="form-group">
                                <!-- <label>Other Two</label> -->
                                <div class="input-group mb-3">
                                  <input type="text" name="otherText8" class="form-control" id="otherText8" placeholder="Description" style="width:65%;"/>
                                    <input type="number" name="other8" id="other8" placeholder="Charges" class="form-control" style="width:35%;"/>
                                </div>
                              </div>
                              <!-- /.form-group -->
                              <div class="form-group">
                                  <!-- <label>Other Three</label> -->
                                  <div class="input-group mb-3">
                                    <input type="text" name="otherText9" class="form-control" id="otherText9" placeholder="Description" style="width:65%;"/>
                                      <input type="number" name="other9" id="other9" placeholder="Charges" class="form-control" style="width:35%;"/>
                                  </div>
                              </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                              <div class="form-group">
                                  <!-- <label>Other Four</label> -->
                                  <div class="input-group mb-3">
                                    <input type="text" name="otherText10" class="form-control" id="otherText10" placeholder="Description" style="width:65%;"/>
                                      <input type="number" name="other10" id="other10" placeholder="Charges" class="form-control" style="width:35%;"/>
                                  </div>
                              </div>
                              <div class="form-group">
                                <!-- <label>Other Five</label> -->
                                <div class="input-group mb-3">
                                  <input type="text" name="otherText11" class="form-control" id="otherText11" placeholder="Description" style="width:65%;"/>
                                    <input type="number" name="other11" id="other11" placeholder="Charges" class="form-control" style="width:35%;"/>
                                </div>
                              </div>
                              <!-- /.form-group -->
                              <div class="form-group">
                                <!-- <label>Other Six</label> -->
                                <div class="input-group mb-3">
                                  <input type="text" name="otherText12" class="form-control" id="otherText12" placeholder="Description" style="width:65%;"/>
                                    <input type="number" name="other12" id="other12" placeholder="Charges" class="form-control" style="width:35%;"/>
                                </div>
                              </div>
                              <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->
                        </div>
                      </div>
                    <!-- /.card -->
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-6" style="margin:0;">
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
      var bsf = document.getElementById("bsf").value;
      var shortStay = document.getElementById("shortStay").value;
      var bp = document.getElementById("bp").value;
      var ecg = document.getElementById("ecg").value;
      var other1 = document.getElementById("other1").value;
      var other2= document.getElementById("other2").value;
      var other3 = document.getElementById("other3").value;
      var other4 = document.getElementById("other4").value;
      var other5 = document.getElementById("other5").value;
      var other6 = document.getElementById("other6").value;
      var other7 = document.getElementById("other7").value;
      var other8 = document.getElementById("other8").value;
      var other9 = document.getElementById("other9").value;
      var other10 = document.getElementById("other10").value;
      var other11 = document.getElementById("other11").value;
      var other12 = document.getElementById("other12").value;
      var totalBill = +moCharge+ +injectionIM+ +injectionIV+ +ivLine+ +ivInfusion+ +stitchInTotal+ +stitchOutTotal+ +bsf+ +shortStay+ +bp+ +ecg+ +other1+ +other2+ +other3+ +other4+ +other5+ +other6+ +other7+ +other8+ +other9+ +other10+ +other11+ +other12;
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