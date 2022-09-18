<?php 
  // Session Start
  session_start();
  if (isset($_SESSION['uuid'])) {
  // Get MRID and Type from URL  
  $sid = (isset($_GET['sid']) ? $_GET['sid'] : ''); 
  $type = (isset($_GET['type']) ? $_GET['type'] : '');
  // Connection File
  include('backend_components/connection.php'); 
    // Form Header File
  include('components/form_header.php'); 
    // Navbar File
  include('components/navbar.php'); 
  

  // Main Sidebar Container
  include('components/sidebar.php'); 
  
  //Check if MRID is empty or not 
  if (!empty($sid) && !empty($type)) {
    $sql="SELECT * FROM `indoor_slip` WHERE `SLIP_ID` = '$sid'";
    $qsql = mysqli_query($db,$sql);
    $patdata = mysqli_fetch_array($qsql);
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"></section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
    
        <div class="card card-info">
          <div class="card-header">
            <?php
                if ($type == "gynae") {
                  echo '<h3 class="card-title"><i class="nav-icon fas fa-hospital-user"></i> Gynae Patient Bill</h3>';
                }else if ($type == "gensurgery") {
                  echo '<h3 class="card-title"><i class="nav-icon fas fa-hospital-user"></i> General Surgery Bill</h3>';
                }else if ($type == "genillness") {
                  echo '<h3 class="card-title"><i class="nav-icon fas fa-hospital-user"></i> General Illness Bill</h3>';
                }else if ($type == "eye") {
                  echo '<h3 class="card-title"><i class="nav-icon fas fa-hospital-user"></i> Eye Patient Bill</h3>';
                }
            ?>
            <div class="card-tools">
              <span id='clockDT'></span>
            </div>
          </div>
          <!-- ****************************** -->
          <!-- **Gynae, Gen Surgery and Gen illness Form** -->
          <!-- ****************************** -->
          <form action="" method="post" enctype="multipart/form-data">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                  <div class="col-md-6">

                      <input type="text" name="admdate" id="slipDate" value="<?php echo $patdata['SLIP_DATE_TIME'] ; ?>" hidden readonly>
                      <input type="text" name="doctor" value="<?php echo $patdata['DOCTOR_NAME'] ; ?>" hidden readonly>
                      <input type="text" name="procedure" value="<?php echo $patdata['SLIP_PROCEDURE'] ; ?>" hidden readonly>
                      <input type="text" name="type" value="<?php echo $patdata['SLIP_TYPE'] ; ?>" hidden readonly>
                      <input type="text" name="disdate" id="disdate" hidden/>
                      <input type="text" name="address" id="address" value="<?php echo $patrow['PATIENT_ADDRESS']; ?>" hidden readonly/>
                      <input type="text" name="age" id="age" value="<?php echo $patrow['PATIENT_AGE']; ?>" hidden readonly/>
                      <input type="text" name="gender" id="gender" value="<?php echo $patrow['PATIENT_GENDER']; ?>" hidden readonly/>
                      <input type="text" name="by" value="<?php echo $_SESSION['uuid'] ; ?>" hidden readonly>

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
                      <?php if ($type == "gynae" || $type == "gensurgery") { ?>
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
                      <?php } 
                      if ($type == "genillness") { ?>
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
                      <?php } ?>
                  </div>
                  <!-- /.col -->
                  <div class="col-md-6">
                    <?php if ($type == "gynae" || $type == "gensurgery") { ?>
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
                    <?php } 
                       if ($type == "gynae" || $type == "gensurgery" || $type == "genillness") { 
                    ?>
                      <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                          <?php if ($type == "genillness") {
                           ?>
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
                           <?php
                          }else{?>
                          <div class="form-group col-md-6">
                              <label>Consultant Visit Charges</label>
                              <input type="number" name="conChargeThree" class="form-control" id="conCharge" placeholder="Rates May Varies">
                          </div>
                          <div class="form-group col-md-6">
                              <label>M O Charges</label>
                              <input type="number" name="moChargeTwo" id="moCharge" placeholder="Rate is 2000" class="form-control"/>
                          </div>
                          <?php }?>
                      </div>
                      <div class="form-group col-md-12">
                          <label>Private Room Charges</label>
                          <div style="display:flex;">
                              <select class="form-control select2bs4"  style="width:50%;" name="prChargeOne" id="prChargeOne" onchange="getPrTotal()" style="width: 100%;">
                                  <option value="0" selected="selected">Select Private Room Charges</option>
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
                      <?php } ?>
                      <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                          <?php if ($type != "eye") { ?>
                              <div class="form-group col-md-6">
                              <label>Total Bill</label>
                                <div class="input-group mb-3">
                                  <input type="number" name="tbill" id="totalBill" placeholder="Total Bill" class="form-control" readonly/>
                                  <?php if ($type == "genillness") {
                                    ?>
                                      <span class="input-group-append">
                                        <button type="button" onclick="genIllnessTotal();" class="btn btn-block btn-primary">calculate</button>
                                      </span>  
                                    <?php
                                  } else { ?>
                                      <span class="input-group-append">
                                        <button type="button" onclick="genSurgeryTotal();" class="btn btn-block btn-primary">calculate</button>
                                      </span>
                                  <?php } ?>
                                  
                                </div>
                            </div>  
                          <?php }else { ?>
                            <div class="form-group col-md-6">
                              <label>Total Bill</label>
                                  <input type="number" name="tbill" id="totalBill" onchange="feeFunction(this)" placeholder="Total Bill" class="form-control"/>
                            </div>
                          <?php } ?>
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
              <button type="submit" name="indoor-submit" class="btn btn-block btn-primary">Submit</button>
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
<script src="dist/js/bill_script.js"></script>
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