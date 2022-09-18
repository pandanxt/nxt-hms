<?php 
  // Session Start
  session_start();
  $sid = (isset($_GET['sid']) ? $_GET['sid'] : ''); 
  $type = (isset($_GET['type']) ? $_GET['type'] : '');
 
  if (isset($_SESSION['uuid'])) {
    include('backend_components/connection.php'); 
    include('components/form_header.php'); 
    include('components/navbar.php'); 
    include('components/sidebar.php'); 
?>
<div class="content-wrapper">
  <section class="content-header"></section>
  <section class="content">
    <div class="container-fluid">
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title"><i class="nav-icon fas fa-hospital-user"></i> Gynae Patient Bill</h3>
          <div class="card-tools">
            <span id='clockDT'></span>
          </div>
        </div>
        <!-- Indoor Bill Form -->
        <?php if ($type == 'INDOOR_SLIP') { ?>
          <form action="" method="post" enctype="multipart/form-data">
          <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-3">
                            <label>Patient MR_ID</label>
                            <input type="text" class="form-control" name="mrid" value="" readonly/>
                        </div>
                        <div class="form-group col-md-5">
                            <label>Patient Name</label>
                            <input type="text" name="name" class="form-control" value="" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Patient Mobile</label>
                            <input type="text" class="form-control" name="phone" value="" readonly/>
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
                            <label>CTG Charges</label>
                            <input type="number" class="form-control" name="ctg" id="ctg" placeholder="Rate is 2,000" />
                        </div>
                        <div class="form-group col-md-4">
                            <label>Recovery Room</label>
                            <input type="number" class="form-control" name="rrCharge" id="rrCharge" placeholder="Rate is 5,000" />
                        </div>
                    </div>
                    <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-5">
                            <label>Labour Room Charges</label>
                            <div style="display:flex;">
                                <input type="number" name="chargeLR" class="form-control" id="chargeLR" placeholder="Rate is 8,000">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <label>Other</label>
                            <div class="input-group mb-3">
                              <input type="text" name="otherText" class="form-control" id="otherText" placeholder="Description" style="width:65%;"/>
                                <input type="number" name="other" id="other" placeholder="Charges" class="form-control" style="width:35%;"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="display:flex;margin:0;">
                      <div class="form-group col-md-4">
                        <label>Oxygen Charges</label>
                        <div style="display:flex;">
                            <input type="number" style="width:40%;" name="oxChargeOne" class="form-control" id="oxChargeOne" value="0" onchange="getOxTotal()" placeholder="No. of Days"/>
                            <input type="number" style="width:60%;" name="oxChargeTwo" class="form-control" id="oxChargeTwo"  placeholder="Total Charges" readonly/>
                          </div>
                      </div>                       
                      <div class="form-group col-md-4">
                        <label>Nursing Charges</label>
                          <div style="display:flex;">
                            <input type="number" style="width:40%;" name="nurChargeOne" class="form-control" id="nurChargeOne" value="0" onchange="getNurTotal()" placeholder="No. of Days"/>
                            <input type="number" style="width:60%;" name="nurChargeTwo" class="form-control" id="nurChargeTwo" placeholder="Total Charges" readonly/>
                          </div>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Monitoring Charges</label>
                          <div style="display:flex;">
                            <input type="number" style="width:40%;" name="monChargeOne" class="form-control" id="monChargeOne" value="0" onchange="getMonTotal()" placeholder="No. of Days"/>
                            <input type="number" style="width:60%;" name="monChargeTwo" class="form-control" id="monChargeTwo"  placeholder="Total Charges" readonly/>
                          </div>
                      </div>
                    </div>
                </div>

                <div class="col-md-6">
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
                  <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                    <div class="col-md-6">
                      <label>Consultant Charges (Per Visit)</label>
                      <div class="input-group mb-3">
                          <input type="number" style="width:40%;" name="conChargeOne" class="form-control" id="conChargeOne" onchange="getConCharge(this);" value="" placeholder="Per-Visit"/>
                          <input type="number" style="width:20%;" name="conChargeTwo" class="form-control" id="conChargeTwo" onchange="getConDay(this);" value="1" placeholder="Days"/>
                          <input type="number" style="width:40%;" name="conChargeThree" class="form-control" id="conChargeThree"  placeholder="Total" value="" readonly/>
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Medical Officer Charges(Per day)</label>
                        <div style="display:flex;">
                          <input type="number" style="width:40%;" name="moChargeOne" class="form-control" id="moChargeOne" value="0" onchange="getMoTotal()" placeholder="No. of Days"/>
                          <input type="number" style="width:60%;" name="moChargeTwo" class="form-control" id="moChargeTwo"  placeholder="Total Charges" readonly/>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                    <div class="form-group col-md-6">
                        <label>Consultant Visit Charges</label>
                        <input type="number" name="conChargeThree" class="form-control" id="conCharge" placeholder="Rates May Varies">
                    </div>
                    <div class="form-group col-md-6">
                        <label>M O Charges</label>
                        <input type="number" name="moChargeTwo" id="moCharge" placeholder="Rate is 2000" class="form-control"/>
                    </div>
                  </div>
                  <div class="form-group col-md-12">
                      <label>Private Room Charges</label>
                      <div style="display:flex;">
                          <select class="form-control select2bs4"  style="width:50%;" name="prChargeOne" id="prChargeOne" onchange="getPrTotal()" style="width: 100%;">
                            <option value="0" selected="selected">Select Private Room Charges</option>
                          </select> 
                          <input type="number" style="width:20%;" name="prChargeTwo" class="form-control" id="prChargeTwo" value="1" onchange="getPrTotal()" placeholder="No. of Days"/>
                          <input type="number" style="width:30%;" name="prChargeThree" class="form-control" id="prChargeThree"  placeholder="Total Charges" readonly/>
                        </div>
                  </div>                    
                  <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                    <div class="form-group col-md-4">
                      <label>Total Bill</label>
                        <div class="input-group mb-3">
                          <input type="number" name="tbill" id="totalBill" placeholder="Total Bill" class="form-control" readonly/>
                              <span class="input-group-append">
                                <button type="button" onclick="genIllnessTotal();" class="btn btn-block btn-primary">calculate</button>
                              </span>  
                              <!-- <span class="input-group-append">
                                <button type="button" onclick="genSurgeryTotal();" class="btn btn-block btn-primary">calculate</button>
                              </span> -->
                        </div>
                    </div>  
                    <div class="form-group col-md-3">
                      <label>Total Bill</label>
                      <input type="number" name="tbill" id="totalBill" onchange="feeFunction(this)" placeholder="Total Bill" class="form-control"/>
                    </div>
                    <div class="form-group col-md-2">
                      <label>Discount</label>
                      <input type="number" name="discount"  onchange="discFunction(this)" class="form-control" id="discount" placeholder="Discount">
                    </div>
                    <div class="form-group col-md-3">
                      <label>Final Bill</label>
                      <input type="number" name="fbill" id="finalBill" placeholder="Final Bill" class="form-control" readonly/>
                    </div>
                  </div>
                </div>
            </div>
          </div>
          <div class="card-footer" style="text-align: right;">
            <button type="submit" name="indoor-submit" class="btn btn-block btn-primary">Submit</button>
          </div>
          </div>
        </form>
        <?php }else if ($type == 'EMERGENCY_SLIP') { ?>
            <!-- Emergency Bill Form -->
        <form action="" method="post" enctype="multipart/form-data">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                  <div class="form-group col-md-6">
                    <label>Patient MR_ID</label>
                    <input type="text" class="form-control" name="mrid" value="" readonly/>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Patient Name</label>
                    <input type="text" name="name" class="form-control" value="" readonly>
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
                  </div>
                  <div class="form-group col-md-6">
                    <label>Per Stitch Out x 100</label>
                      <div style="display:flex;">
                        <input type="number" style="width:60%;"  name="stitchout" class="form-control" id="stitchOut" onchange="getStitchOutTotal()" placeholder="No# of Stitches">
                        <input type="number" style="width:40%;" name="stitchOutTotal" class="form-control" id="stitchOutTotal" placeholder="Amount" readonly/>
                      </div>
                  </div>
                </div>
              </div>
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
                <div class="card card-default">
                  <div class="card-header">
                    <h3 class="card-title">Add More Fields</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#multiFieldRight" aria-expanded="false" aria-controls="multiFieldRight">
                        <i class="fas fa-plus"></i>
                      </button>
                    </div>
                  </div>
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
                </div>
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
            </div>
          </div>
          <div class="card-footer" style="text-align: right;">
            <button type="submit" name="emergency-bill-submit" class="btn btn-block btn-primary">Submit</button>
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
 include('components/form_script.php'); 
}else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
}
?>