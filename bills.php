<?php 
  // Session Start
  session_start();
  $sid = (isset($_GET['sid']) ? $_GET['sid'] : ''); 
  $type = (isset($_GET['type']) ? $_GET['type'] : '');
  $subtype = (isset($_GET['subtype']) ? $_GET['subtype'] : '');
  
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
            <?php if ($type == "EMERGENCY") {
              echo "Emergency Bill";
            } else if($type == "INDOOR") {
              if ($subtype == "GYNEACOLOGY_PATIENT") {
                echo "Indoor Gyneacology Bill";
              }else if ($subtype == "GENERAL_SURGERY_PATIENT") {
                echo "Indoor General Surgery Bill";
              }else if ($subtype == "GENERAL_ILLNESS_PATIENT") {
                echo "Indoor General Illness Bill";
              }else if ($subtype == "EYE_PATIENT") {
                echo "Indoor Eye Bill";
              }
            } ?>
          </h3>
          <div class="card-tools">
            <span id='clockDT'></span>
          </div>
        </div>
        <!-- Indoor Bill Form -->
        <?php if ($type == 'INDOOR') {
          $indoor_sql = "SELECT * FROM `me_slip` WHERE `SLIP_UUID` = '$sid' AND `SLIP_TYPE` = '$type' AND `SLIP_SUB_TYPE` = '$subtype'";
          $query_indoor = mysqli_query($db,$indoor_sql);
          $result = mysqli_fetch_array($query_indoor);
        ?>
          <form action="javascript:void(0)" method="post" enctype="multipart/form-data" id="addIndoorBill">
          <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                      <input type="text" name="billId" id="billId" hidden readonly/>
                      <input type="text" name="slipId" id="slipId" value="<?php echo $result['SLIP_UUID'] ; ?>" hidden readonly/>
                      <input type="text" name="staffId" id="staffId" value="<?php echo $_SESSION['uuid'] ; ?>" hidden readonly>
                      <div class="form-group col-md-3">
                        <label>MRD Number</label>
                        <input type="text" class="form-control" name="mrId" id="mrId" value="<?php echo $result['SLIP_MRID'] ; ?>" readonly/>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Patient Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?php echo $result['SLIP_NAME'] ; ?>" readonly>
                      </div>
                      <div class="form-group col-md-3">
                        <label>Patient Mobile</label>
                        <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $result['SLIP_MOBILE'] ; ?>" readonly/>
                      </div>
                    </div>
                    <?php if ($subtype == "GYNEACOLOGY_PATIENT" || $subtype == "GENERAL_SURGERY_PATIENT") { ?>
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
                        <input type="number" name="pedCharge" class="form-control" id="pedCharge" placeholder="Rate Varies">
                      </div>
                      <div class="form-group col-md-4">
                        <label>CTG Charges</label>
                        <input type="number" class="form-control" name="ctg" id="ctg" placeholder="Rate is 700" />
                      </div>
                      <div class="form-group col-md-4">
                        <label>Recovery Room</label>
                        <input type="number" class="form-control" name="rrCharge" id="rrCharge" placeholder="Rate is 5,000" />
                      </div>
                    </div>
                    <?php 
                      } 
                      if ($subtype == "GENERAL_ILLNESS_PATIENT") {
                    ?>
                    <div class="form-group" style="display:flex;margin:0;">
                      <div class="form-group col-md-4">
                        <label>Oxygen Charges</label>
                        <div style="display:flex;">
                          <input type="number" style="width:40%;" name="oxChargeOne" class="form-control" id="oxChargeOne" value="0" onchange="getOxTotal()" placeholder="No. of Days"/>
                          <input type="number" style="width:60%;" name="oxCharge" class="form-control" id="oxCharge"  placeholder="Total Charges" readonly/>
                        </div>
                      </div>                       
                      <div class="form-group col-md-4">
                        <label>Nursing Charges</label>
                        <div style="display:flex;">
                          <input type="number" style="width:40%;" name="nurChargeOne" class="form-control" id="nurChargeOne" value="0" onchange="getNurTotal()" placeholder="No. of Days"/>
                          <input type="number" style="width:60%;" name="nurCharge" class="form-control" id="nurCharge" placeholder="Total Charges" readonly/>
                        </div>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Monitoring Charges</label>
                        <div style="display:flex;">
                          <input type="number" style="width:40%;" name="monChargeIndoorOne" class="form-control" id="monChargeIndoorOne" value="0" onchange="getIndoorMonTotal()" placeholder="No. of Days"/>
                          <input type="number" style="width:60%;" name="monChargeIndoorTwo" class="form-control" id="monChargeIndoorTwo"  placeholder="Total Charges" readonly/>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                      <?php if ($subtype == "GYNEACOLOGY_PATIENT" || $subtype == "GENERAL_SURGERY_PATIENT") { ?>
                      <div class="form-group col-md-8">
                        <label>Labour Room Charges</label>
                        <input type="number" name="chargeLR" class="form-control" id="chargeLR" placeholder="Rate is 8,000">
                      </div>
                      <?php 
                        } 
                        if ($subtype == "GYNEACOLOGY_PATIENT" || $subtype == "GENERAL_SURGERY_PATIENT" || $subtype == "GENERAL_ILLNESS_PATIENT") 
                        {
                      ?>
                        <!-- Extra Field Button -->
                        <div class="card-tools mt-3">
                          <br>
                          <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#multiFieldLeft" aria-expanded="false" aria-controls="multiFieldRight">
                            <i class="fas fa-plus"></i> More Fields
                          </button>
                        </div>
                      <?php } ?>
                    </div>
                    <?php 
                      if ($subtype == "GYNEACOLOGY_PATIENT" || $subtype == "GENERAL_SURGERY_PATIENT" || $subtype == "GENERAL_ILLNESS_PATIENT") 
                      {
                    ?>
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
                    <?php } ?>
                </div>

                <div class="col-md-6">
                  <?php if ($subtype == "GYNEACOLOGY_PATIENT" || $subtype == "GENERAL_SURGERY_PATIENT") { ?>
                  <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                    <div class="form-group col-md-4">
                      <label>Nursury Charges</label>
                      <input type="number" name="nurCharge" id="nurCharge" placeholder="Rate is 8,000" class="form-control"/>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Nursury Staff Charges</label>
                      <input type="number" name="nurStCharge" class="form-control" id="nurStCharge" placeholder="Rate is 1500"/>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Operation Charges</label>
                      <input type="number" name="opCharge" class="form-control" id="opCharge" placeholder="Rate is 10,000"/>
                    </div>
                  </div>
                  <?php 
                    } 
                    if ($subtype == "GENERAL_ILLNESS_PATIENT" || $subtype == "GYNEACOLOGY_PATIENT" || $subtype == "GENERAL_SURGERY_PATIENT") {
                  ?>
                  <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                    <div class="col-md-6">
                      <label>Consultant Charges (Per Visit)</label>
                      <div class="input-group mb-3">
                        <input type="number" style="width:40%;" name="conChargeOne" class="form-control" id="conChargeOne" onchange="getConCharge(this);" value="" placeholder="Per-Visit"/>
                        <input type="number" style="width:20%;" name="conChargeTwo" class="form-control" id="conChargeTwo" onchange="getConDay(this);" value="1" placeholder="Days"/>
                        <input type="number" style="width:40%;" name="conCharge" class="form-control" id="conCharge"  placeholder="Total" value="" readonly/>
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Medical Officer Charges(Per day)</label>
                        <div style="display:flex;">
                          <input type="number" style="width:40%;" name="moChargeOne" class="form-control" id="moChargeOne" value="0" onchange="getMoTotal()" placeholder="No. of Days"/>
                          <input type="number" style="width:60%;" name="moCharge" class="form-control" id="moCharge"  placeholder="Total Charges" readonly/>
                        </div>
                    </div>
                  </div>
                  <?php
                   }
                   if ($subtype != "EYE_PATIENT") {
                  ?>
                  <div class="form-group col-md-12">
                      <label>Private Room Charges</label>
                      <div style="display:flex;">
                        <select class="form-control select2bs4"  style="width:50%;" name="prChargeOne" id="prChargeOne" onchange="getPrTotal()" style="width: 100%;">
                          <option value="0" selected="selected">Select Private Room Charges</option>
                          <?php
                            $room = 'SELECT `ROOM_UUID`, `ROOM_NAME`,`ROOM_RATE` FROM `me_room` WHERE `ROOM_STATUS` = 1';
                            $result = mysqli_query($db, $room) or die (mysqli_error($db));
                              while ($row = mysqli_fetch_array($result)) {
                              $id = $row['ROOM_RATE'];  
                              $name = $row['ROOM_NAME'];
                              echo '<option value="'.$id.'">'.$name.'</option>'; 
                            }
                          ?>
                        </select> 
                        <input type="number" style="width:20%;" name="prChargeTwo" class="form-control" id="prChargeTwo" value="1" onchange="getPrTotal()" placeholder="No. of Days"/>
                        <input type="number" style="width:30%;" name="prCharge" class="form-control" id="prCharge"  placeholder="Total Charges" readonly/>
                      </div>
                  </div>                    
                  <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                    <div class="form-group col-md-5">
                      <label>Total Bill</label>
                        <div class="input-group mb-3">
                          <input type="number" name="totalBill" id="totalBill" placeholder="Total Bill" class="form-control" readonly/>
                          <?php if ($subtype == "GENERAL_ILLNESS_PATIENT") { ?>
                            <span class="input-group-append">
                              <button type="button" onclick="genIllnessTotal();" class="btn btn-block btn-primary">calculate</button>
                            </span>  
                          <?php }else if ($subtype == "GENERAL_SURGERY_PATIENT" || $subtype == "GYNEACOLOGY_PATIENT") { ?>
                            <span class="input-group-append">
                              <button type="button" onclick="genSurgeryTotal();" class="btn btn-block btn-primary">calculate</button>
                            </span>
                          <?php } ?>
                        </div>
                    </div>  
                    <div class="form-group col-md-3">
                      <label>Discount</label>
                      <input type="number" name="discount"  onchange="genDiscFunction(this)" class="form-control" id="discount" placeholder="Discount">
                    </div>
                    <div class="form-group col-md-4">
                      <label>Final Bill</label>
                      <input type="number" name="finalBill" id="genFinalBill" placeholder="Final Bill" class="form-control" readonly/>
                    </div>
                  </div>
                  <?php } if ($subtype == "EYE_PATIENT" && $subtype != "GENERAL_SURGERY_PATIENT" && $subtype != "GENERAL_ILLNESS_PATIENT" && $subtype != "GYNEACOLOGY_PATIENT") { ?>
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                      <div class="form-group col-md-4">
                        <label>Total Bill</label>
                        <input type="number" name="totalBill" id="totalBill" onchange="feeFunction(this)" placeholder="Total Bill" class="form-control"/>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Discount</label>
                        <input type="number" name="discount"  onchange="eyeDiscFunction(this)" class="form-control" id="discount" placeholder="Discount">
                      </div>
                      <div class="form-group col-md-4">
                        <label>Final Bill</label>
                        <input type="number" name="finalBill" id="eyeFinalBill" placeholder="Final Bill" class="form-control" readonly/>
                      </div>
                    </div>
                    <?php } ?>
                </div>
                
            </div>
          </div>
          <div class="card-footer" style="text-align: right;">
            <button type="submit" name="submit" class="btn btn-block btn-primary">Submit</button>
          </div>
          </div>
        </form>

        <?php }else if ($type == 'EMERGENCY') { 
          $emergency_sql = "SELECT * FROM `me_slip` WHERE `SLIP_UUID` = '$sid' AND `SLIP_TYPE` = '$type'";
          $query_emergency = mysqli_query($db,$emergency_sql);
          $result = mysqli_fetch_array($query_emergency);
        ?>
        <!-- Emergency Bill Form -->
        <form action="javascript:void(0)" method="post" enctype="multipart/form-data" id="addEmergencyBill">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                  <input type="text" name="billId" id="billId" hidden readonly/>
                  <input type="text" name="slipId" id="slipId" value="<?php echo $result['SLIP_UUID'] ; ?>" hidden readonly/>
                  <input type="text" name="staffId" id="staffId" value="<?php echo $_SESSION['uuid'] ; ?>" hidden readonly>
                  <div class="form-group col-md-3">
                    <label>MRD Number</label>
                    <input type="text" class="form-control" name="mrId" id="mrId" value="<?php echo $result['SLIP_MRID'] ; ?>" readonly/>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Patient Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?php echo $result['SLIP_NAME'] ; ?>" readonly>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Patient Mobile</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $result['SLIP_MOBILE'] ; ?>" readonly/>
                  </div>
                </div>
                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                  <div class="form-group col-md-4">
                    <label>ER Slip / MO Fee</label>
                    <input type="number" name="moCharge" id="moCharge" placeholder="Charges-500" class="form-control"/>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Injection I/M</label>
                    <input type="number" name="injectionIM" class="form-control" id="injectionIM" placeholder="Charges-100">
                  </div>
                  <div class="form-group col-md-4">
                    <label>I/V Line (In/Out)</label>
                    <select class="form-control select2bs4" name="ivLine" id="ivLine" style="width: 100%;">
                      <option value="0" selected="selected">Select</option>
                      <option value="250">In - 250</option>
                      <option value="150">Out - 150</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                  <div class="form-group col-md-4">
                      <label>Per Stitch In x 350</label>
                      <div style="display:flex;">
                        <input type="number" style="width:40%;" name="stitchIn" class="form-control" id="stitchIn" onchange="getStitchInTotal()" placeholder="No# Stitches">
                        <input type="number" style="width:60%;" name="stitchInTotal" class="form-control" id="stitchInTotal" placeholder="350" readonly/>
                      </div>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Per Stitch Out x 150</label>
                      <div style="display:flex;">
                        <input type="number" style="width:40%;"  name="stitchOut" class="form-control" id="stitchOut" onchange="getStitchOutTotal()" placeholder="No# of Stitches">
                        <input type="number" style="width:60%;" name="stitchOutTotal" class="form-control" id="stitchOutTotal" placeholder="150" readonly/>
                      </div>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Drips</label>
                    <select class="form-control select2bs4" name="drip" id="drip" style="width: 100%;">
                      <option value="0" selected="selected">Select</option>
                      <option value="400">100ml - 400</option>
                      <option value="700">500ml - 700</option>
                      <option value="1200">1000ml - 1200</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                  <div class="form-group col-md-4">
                    <label>Drip Venofar</label>
                    <input type="number" name="venofar" class="form-control" id="venofar" placeholder="Charges-1200"/>
                  </div>
                  <div class="form-group col-md-4">
                      <label>CTG Charges</label>
                      <input type="number" class="form-control" name="ctg" id="ctg" placeholder="Charges - 700" />
                  </div>
                  <div class="form-group col-md-4">
                      <label>Stomach Wash</label>
                      <input type="number" class="form-control" name="stomachWash" id="stomachWash" placeholder="Charges - 3500" />
                  </div>
                </div>
                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                  <div class="form-group col-md-4">
                    <label>Foley Catheter</label>
                    <select class="form-control select2bs4" name="foleyCath" id="foleyCath" style="width: 100%;">
                      <option value="0" selected="selected">Attached / Removed</option>
                      <option value="1200">Attached - 1200</option>
                      <option value="500">Removed - 400</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label>ECG</label>
                    <input type="number" class="form-control" name="ecg" id="ecg" placeholder="700" />
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
                  <div class="form-group col-md-4">
                    <label>Infusion + Antibiotic</label>
                    <select class="form-control select2bs4" name="infusionAntibiotic" id="infusionAntibiotic" style="width: 100%;">
                      <option value="0" selected="selected">100ml/500ml</option>
                      <option value="400">100ml - 400</option>
                      <option value="700">500ml - 700</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label>BSF / BSR</label>
                    <input type="number" name="bsf" class="form-control" id="bsf" placeholder="Charges-150"/>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Injection I/V</label>
                    <input type="number" class="form-control" name="injectionIV" id="injectionIV" placeholder="Charges-250"/>
                  </div>
                </div>
                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                  <div class="form-group col-md-4">
                    <label>Short Stay <small>(After One Hour)</small></label>
                    <input type="number" name="shortStay" id="shortStay" placeholder="Short Stay" class="form-control"/>
                  </div>
                  <div class="form-group col-md-4">
                    <label>BP</label>
                    <input type="number" name="bp" class="form-control" id="bp" placeholder="100">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Dressing</label>
                    <select class="form-control select2bs4" name="dressing" id="dressing" style="width: 100%;">
                      <option value="0" selected="selected">Upto 3 Inch or More</option>
                      <option value="300">Dressing Small - 300</option>
                      <option value="600">Dressing Large - 600</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                  <div class="form-group col-md-4">
                    <label>Nebulization</label>
                    <input type="number" name="nebulization" class="form-control" id="nebulization" placeholder="350"/>
                  </div>
                  <div class="form-group col-md-5">
                    <label>Monitor Charge</label>
                      <div style="display:flex;">
                        <input type="number" style="width:35%;" name="monChargeOne" class="form-control" id="monChargeOne" value="0" onchange="getMonTotal()" placeholder="No. of Days"/>
                        <input type="number" style="width:65%;" name="monChargeTwo" class="form-control" id="monChargeTwo"  placeholder="1200" readonly/>
                      </div>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Enema</label>
                    <input type="number" class="form-control" name="enema" id="enema" placeholder="700" />
                  </div>
                </div>
                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                  <div class="form-group col-md-4">
                    <label>Blood Transfusion</label>
                      <input type="number" name="bloodTransfusion" class="form-control" id="bloodTransfusion" placeholder="Rate Varies">
                  </div>
                  <div class="form-group col-md-4">
                      <label>Endo Tracheal Tube</label>
                      <input type="number" class="form-control" name="ett" id="ett" placeholder="Charges - 3500" />
                  </div>
                  <div class="form-group col-md-4">
                    <label>Ascitic</label>
                    <select class="form-control select2bs4" name="ascitic" id="ascitic" style="width: 100%;">
                      <option value="0" selected="selected">Select Ascitic</option>
                      <option value="500">Therapeutic - 500</option>
                      <option value="3500">Diagnostic - 3500</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                  <div class="form-group col-md-5">
                    <label>Pleural Fuid</label>
                    <select class="form-control select2bs4" name="pleuralFuid" id="pleuralFuid" style="width: 100%;">
                      <option value="0" selected="selected">Select Pleural Fuid</option>
                      <option value="3500">Therapeutic - 3500</option>
                      <option value="1500">TAP Diagnostic - 1500</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                      <label>Lumber Puncture</label>
                      <input type="number" class="form-control" name="lumberPuncture" id="lumberPuncture" placeholder="Charges - 2500" />
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
        <?php } ?>
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