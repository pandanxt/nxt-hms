<?php 
  // Session Start
  session_start();
//   $sid = (isset($_GET['sid']) ? $_GET['sid'] : ''); 
//   $type = (isset($_GET['type']) ? $_GET['type'] : '');
//   $subtype = (isset($_GET['subtype']) ? $_GET['subtype'] : '');
  
  if (isset($_SESSION['uuid'])) {
    include('backend_components/connection.php'); 
    // File Header
    include('components/file_header.php');
    include('components/navbar.php'); 
    include('components/sidebar.php'); 
?>
<div class="content-wrapper">
  <section class="content-header"></section>
  <section class="content">
    <div class="container-fluid">
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">
            <i class="nav-icon fas fa-hospital-user"></i> 
            Emergency Bill
          </h3>
          <div class="card-tools">
            <span id='clockDT'></span>
          </div>
        </div>
        <!-- Emergency Bill Form -->
        <form action="javascript:void(0)" method="post" enctype="multipart/form-data" id="addStandAloneEmergencyBill">
          <div class="card-body">
            <div class="row">
             
              <div class="col-md-6">
                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                  <input type="text" name="billId" id="billId" hidden readonly/>
                  <input type="text" name="slipId" id="slipId" hidden readonly/>
                  <input type="text" name="staffId" id="staffId" value="<?php echo $_SESSION['uuid'] ; ?>" hidden readonly>
                  <div class="form-group col-md-4">
                    <label>Patient MR-ID #</label>
                    <input type="text" name="patId" id="patId" class="form-control" readonly required>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Patient Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Patient Name Here ..." required>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Patient Mobile</label>
                    <input type="tel" name="phone" id="phone" class="form-control" placeholder="Enter without '-'" required>
                  </div>
                </div>
                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                  <div class="form-group col-md-4">
                    <label>ER Slip / MO Fee</label>
                    <input type="number" name="moChargeEmrc" id="moChargeEmrc" placeholder="Charges-750" class="form-control"/>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Injection I/M</label>
                    <input type="number" name="injectionIM" class="form-control" id="injectionIM" placeholder="Charges-150">
                  </div>
                  <div class="form-group col-md-4">
                    <label>I/V Line (In/Out)</label>
                    <select class="form-control select2" name="ivLine" id="ivLine" style="width: 100%;">
                      <option value="0" selected="selected">Select</option>
                      <option value="350">In - 350</option>
                      <option value="200">Out - 200</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                  <div class="form-group col-md-4">
                      <label>Per Stitch In x 450</label>
                      <div style="display:flex;">
                        <input type="number" style="width:40%;" name="stitchIn" class="form-control" id="stitchIn" onchange="getStitchInTotal()" placeholder="No# Stitches">
                        <input type="number" style="width:60%;" name="stitchInTotal" class="form-control" id="stitchInTotal" placeholder="450" readonly/>
                      </div>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Per Stitch Out x 250</label>
                      <div style="display:flex;">
                        <input type="number" style="width:40%;"  name="stitchOut" class="form-control" id="stitchOut" onchange="getStitchOutTotal()" placeholder="No# of Stitches">
                        <input type="number" style="width:60%;" name="stitchOutTotal" class="form-control" id="stitchOutTotal" placeholder="250" readonly/>
                      </div>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Drips</label>
                    <select class="form-control select2" name="drip" id="drip" style="width: 100%;">
                      <option value="0" selected="selected">Select</option>
                      <option value="450">100ml - 450</option>
                      <option value="850">500ml - 850</option>
                      <option value="1350">1000ml - 1350</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                  <div class="form-group col-md-4">
                    <label>Drip Venofar</label>
                    <input type="number" name="venofar" class="form-control" id="venofar" placeholder="Charges-1350"/>
                  </div>
                  <div class="form-group col-md-4">
                      <label>CTG Charges</label>
                      <input type="number" class="form-control" name="ctg" id="ctg" placeholder="Charges - 800" />
                  </div>
                  <div class="form-group col-md-4">
                      <label>Stomach Wash</label>
                      <input type="number" class="form-control" name="stomachWash" id="stomachWash" placeholder="Charges - 4000" />
                  </div>
                </div>
                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                  <div class="form-group col-md-4">
                    <label>Foley Catheter</label>
                    <select class="form-control select2" name="foleyCath" id="foleyCath" style="width: 100%;">
                      <option value="0" selected="selected">Attached / Removed</option>
                      <option value="1350">Attached - 1350</option>
                      <option value="600">Removed - 600</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label>ECG</label>
                    <input type="number" class="form-control" name="ecg" id="ecg" placeholder="800" />
                  </div>
                  <!-- Extra Field Button -->
                  <div class="card-tools mt-3">
                    <br>
                    <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#multiFieldLeft" aria-expanded="false" aria-controls="multiFieldRight">
                      <i class="fas fa-plus"></i> More Fields
                    </button>
                  </div>  
                </div>
                <!-- Extra Fields -->
                <div class="card-body collapse multi-collapse" id="multiFieldLeft">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                          <div class="input-group mb-3">
                            <input type="text" name="otherText1" class="form-control" id="otherText1" placeholder="Description" style="width:65%;"/>
                              <input type="number" name="other1" id="other1" placeholder="Charges" class="form-control" style="width:35%;"/>
                          </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group mb-3">
                          <input type="text" name="otherText2" class="form-control" id="otherText2" placeholder="Description" style="width:65%;"/>
                            <input type="number" name="other2" id="other2" placeholder="Charges" class="form-control" style="width:35%;"/>
                        </div>
                      </div>
                      <div class="form-group">
                          <div class="input-group mb-3">
                            <input type="text" name="otherText3" class="form-control" id="otherText3" placeholder="Description" style="width:65%;"/>
                              <input type="number" name="other3" id="other3" placeholder="Charges" class="form-control" style="width:35%;"/>
                          </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                          <div class="input-group mb-3">
                            <input type="text" name="otherText4" class="form-control" id="otherText4" placeholder="Description" style="width:65%;"/>
                              <input type="number" name="other4" id="other4" placeholder="Charges" class="form-control" style="width:35%;"/>
                          </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group mb-3">
                          <input type="text" name="otherText5" class="form-control" id="otherText5" placeholder="Description" style="width:65%;"/>
                            <input type="number" name="other5" id="other5" placeholder="Charges" class="form-control" style="width:35%;"/>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group mb-3">
                          <input type="text" name="otherText6" class="form-control" id="otherText6" placeholder="Description" style="width:65%;"/>
                            <input type="number" name="other6" id="other6" placeholder="Charges" class="form-control" style="width:35%;"/>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">

                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                    <div class="form-group col-md-2">
                        <label>Patient Age</label>
                        <input type="number" step="0.1" name="age" id="age" class="form-control" placeholder="Enter Age" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Patient Gender</label>
                        <select class="form-control select2" name="gender" id="gender" required style="width: 100%;">
                            <option selected="selected" value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4" id="meDoc">
                        <label>Consultant Name</label>
                        <select class="form-control select2" name="doctor" style="width: 100%;" id="doctor" required>
                            <option disabled selected value="">---- Select Consultant Name ----</option>
                            <?php
                            $doctor = 'SELECT `DOCTOR_UUID`, `DOCTOR_NAME` FROM `me_doctors` WHERE `DOCTOR_TYPE` = "medeast" AND `DOCTOR_STATUS` = "1"';
                            $result = mysqli_query($db, $doctor) or die (mysqli_error($db));
                                while ($row = mysqli_fetch_array($result)) {
                                $id = $row['DOCTOR_UUID'];  
                                $name = $row['DOCTOR_NAME'];
                                echo '<option value="'.$id.'">'.$name.'</option>'; 
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Disposal</label>
                        <select class="form-control select2" name="disposal" id="disposal" required>
                          <option value="OPD">OPD</option>
                          <option value="Admission">Admission</option>
                          <option value="Death">Death</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                  <div class="form-group col-md-4">
                    <label>Infusion + Antibiotic</label>
                    <select class="form-control select2" name="infusionAntibiotic" id="infusionAntibiotic" style="width: 100%;">
                      <option value="0" selected="selected">100ml/500ml</option>
                      <option value="550">100ml - 550</option>
                      <option value="850">500ml - 850</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label>BSF / BSR</label>
                    <input type="number" name="bsf" class="form-control" id="bsf" placeholder="Charges-150"/>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Injection I/V</label>
                    <input type="number" class="form-control" name="injectionIV" id="injectionIV" placeholder="Charges-350"/>
                  </div>
                </div>
                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                  <div class="form-group col-md-4">
                    <label>Short Stay</label>
                    <input type="number" name="shortStay" id="shortStay" placeholder="Short Stay" class="form-control"/>
                  </div>
                  <div class="form-group col-md-4">
                    <label>BP</label>
                    <input type="number" name="bp" class="form-control" id="bp" placeholder="100">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Dressing</label>
                    <select class="form-control select2" name="dressing" id="dressing" style="width: 100%;">
                      <option value="0" selected="selected">Upto 3 Inch or More</option>
                      <option value="450">Dressing Small - 450</option>
                      <option value="450">Dressing Large - 450</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                  <div class="form-group col-md-4">
                    <label>Nebulization</label>
                    <input type="number" name="nebulization" class="form-control" id="nebulization" placeholder="500"/>
                  </div>
                  <div class="form-group col-md-5">
                    <label>Monitor Charge</label>
                      <div style="display:flex;">
                        <input type="number" style="width:35%;" name="monChargeOne" class="form-control" id="monChargeOne" value="0" onchange="getMonTotal()" placeholder="No. of Days"/>
                        <input type="number" style="width:65%;" name="monChargeTwo" class="form-control" id="monChargeTwo"  placeholder="1500" readonly/>
                      </div>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Enema</label>
                    <input type="number" class="form-control" name="enema" id="enema" placeholder="1200" />
                  </div>
                </div>
                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                  <div class="form-group col-md-4">
                    <label>Blood Transfusion</label>
                      <input type="number" name="bloodTransfusion" class="form-control" id="bloodTransfusion" placeholder="5000">
                  </div>
                  <div class="form-group col-md-4">
                      <label>Endo Tracheal Tube</label>
                      <input type="number" class="form-control" name="ett" id="ett" placeholder="Charges - 4000" />
                  </div>
                  <div class="form-group col-md-4">
                    <label>Ascitic</label>
                    <select class="form-control select2" name="ascitic" id="ascitic" style="width: 100%;">
                      <option value="0" selected="selected">Select Ascitic</option>
                      <option value="4000">Therapeutic - 4000</option>
                      <option value="1500">Diagnostic - 1500</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                  <div class="form-group col-md-5">
                    <label>Pleural Fuid</label>
                    <select class="form-control select2" name="pleuralFuid" id="pleuralFuid" style="width: 100%;">
                      <option value="0" selected="selected">Select Pleural Fuid</option>
                      <option value="4000">Therapeutic - 4000</option>
                      <option value="2000">TAP Diagnostic - 2000</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                      <label>Lumber Puncture</label>
                      <input type="number" class="form-control" name="lumberPuncture" id="lumberPuncture" placeholder="Charges - 3000" />
                  </div>
                  <!-- Button For Extra Fields -->
                  <div class="card-tools mt-3">
                    <br>
                    <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#multiFieldRight" aria-expanded="false" aria-controls="multiFieldRight">
                      <i class="fas fa-plus"></i> More Fields
                    </button>
                  </div>
                </div>
                <!-- Extra Fields -->
                <div class="card-body collapse multi-collapse" id="multiFieldRight">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                          <div class="input-group mb-3">
                            <input type="text" name="otherText7" class="form-control" id="otherText7" placeholder="Description" style="width:65%;"/>
                              <input type="number" name="other7" id="other7" placeholder="Charges" class="form-control" style="width:35%;"/>
                          </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group mb-3">
                          <input type="text" name="otherText8" class="form-control" id="otherText8" placeholder="Description" style="width:65%;"/>
                            <input type="number" name="other8" id="other8" placeholder="Charges" class="form-control" style="width:35%;"/>
                        </div>
                      </div>
                      <div class="form-group">
                          <div class="input-group mb-3">
                            <input type="text" name="otherText9" class="form-control" id="otherText9" placeholder="Description" style="width:65%;"/>
                              <input type="number" name="other9" id="other9" placeholder="Charges" class="form-control" style="width:35%;"/>
                          </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                          <div class="input-group mb-3">
                            <input type="text" name="otherText10" class="form-control" id="otherText10" placeholder="Description" style="width:65%;"/>
                              <input type="number" name="other10" id="other10" placeholder="Charges" class="form-control" style="width:35%;"/>
                          </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group mb-3">
                          <input type="text" name="otherText11" class="form-control" id="otherText11" placeholder="Description" style="width:65%;"/>
                            <input type="number" name="other11" id="other11" placeholder="Charges" class="form-control" style="width:35%;"/>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group mb-3">
                          <input type="text" name="otherText12" class="form-control" id="otherText12" placeholder="Description" style="width:65%;"/>
                            <input type="number" name="other12" id="other12" placeholder="Charges" class="form-control" style="width:35%;"/>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                  <div class="form-group col-md-6" style="margin:0;">
                    <label>Total Bill</label>
                      <div class="input-group mb-3">
                        <input type="number" name="totalBill" id="totalBill" placeholder="Total Bill" class="form-control" readonly/>
                        <span class="input-group-append">
                          <button type="button" onclick="calculateEmergencyTotal();" class="btn btn-block btn-primary">calculate</button>
                        </span>
                      </div>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Discount</label>
                    <input type="number" name="discount"  onchange="emrDiscFunction(this)" class="form-control" id="discount" placeholder="Discount">
                  </div>
                  <div class="form-group col-md-3">
                    <label>Final Bill</label>
                    <input type="number" name="finalBill" id="emrFinalBill" placeholder="Final Bill" class="form-control" readonly/>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer" style="text-align: right;">
            <button type="submit" name="submit" class="btn btn-block btn-primary">Submit</button>
          </div>
        </form>
        <?php //} ?>
    </div>
  </section>
</div>
<script src="dist/js/bill_script.js"></script>
<?php
 include('components/footer.php'); 
 echo '</div>';
 // REQUIRED SCRIPTS 
 include('components/file_footer.php'); 
}else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
}
?>