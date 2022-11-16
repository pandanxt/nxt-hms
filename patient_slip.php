<?php 
  // Start Session 
  session_start();
  $type = (isset($_GET['patType']) ? $_GET['patType'] : '');
  $subType = (isset($_GET['patSubType']) ? $_GET['patSubType'] : '');
  if (isset($_SESSION['uuid'])) {
    // Connection File
    include('backend_components/connection.php');
    // Form Header File
    include('components/form_header.php');
    // Navbar File
    include('components/navbar.php');
    // Sidebar File
    include('components/sidebar.php');
    
    if ($type == 'OUTDOOR') {
      $title = 'OPD SLIP';
    }else if ($type == 'INDOOR') {
      $title = 'INDOOR SLIP';
    }else if ($type == 'EMERGENCY') {
      $title = 'EMERGENCY SLIP';
    }
?>
<div class="content-wrapper">
  <section class="content-header"></section>
  <section class="content">
    <div class="container-fluid">
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">
            <i class="nav-icon fas fa-procedures"></i> 
            <?php echo $title; ?>        
          </h3>
          <div class="card-tools">
            <span id='clockDT'></span>
          </div>
        </div>
        <!-- Add Slip Form -->
        <form action="javascript:void(0)" method="post" enctype="multipart/form-data" id="addPatientSlip">

          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="col-md-12" style="display:flex;">
                    <div class="form-group col-md-4">
                        <label>Patient MR-ID #</label>
                        <input type="text" name="patId" id="patId" class="form-control" readonly>
                    </div>
                    <div class="form-group col-md-8">
                        <label>Patient Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Patient Name Here ..." required>
                    </div>
                </div>
                <?php if ($type == 'OUTDOOR') {?>
                <div class="col-md-12" style="display:flex;">
                  <div class="col-md-6">
                    <label for="switchList">Switch List: </label>
                    <select name="switchList" id="switchList" onchange="switchDocList(this.value);">
                      <option value="me">MedEast Doctors</option>
                      <option value="vt">Visiting Doctors</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <span id="addDoc" style="display:none;">
                      <a href="javascript:void(0);" data-toggle="modal" data-target="#visitor-doctor"><i class="fas fa-plus"></i> VISITOR DOCTOR</a>
                    </span>
                  </div>
                </div>
                <?php } ?>
                <div class="col-md-12" style="display:flex;">
                  <?php if ($type != 'EMERGENCY') {?>
                  <div class="form-group col-md-6">
                    <label>Department</label>
                    <select class="form-control select2bs4" id="dept" name="dept" style="width: 100%;" required onchange="showDoctor(this.value)">
                    <option disabled selected value="">---- Select Department ----</option>
                        <?php
                        $dept = 'SELECT `DEPARTMENT_UUID`, `DEPARTMENT_NAME` FROM `me_department` WHERE `DEPARTMENT_STATUS` = "1"';
                        $result = mysqli_query($db, $dept) or die (mysqli_error($db));
                            while ($row = mysqli_fetch_array($result)) {
                            $id = $row['DEPARTMENT_UUID'];  
                            $name = $row['DEPARTMENT_NAME'];
                            echo '<option value="'.$id.'">'.$name.'</option>'; 
                        }
                        ?>
                    </select>
                  </div>
                  <?php } ?>
                  <div class="form-group col-md-6" id="meDoc">
                    <label>Consultant Name</label>
                      <select class="form-control select2bs4" name="doctor" style="width: 100%;" id="doctor" required>
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
                </div>
              </div>
              <div class="col-md-6">
                <div class="col-md-12" style="display:flex;">
                    <div class="form-group col-md-6">
                        <label>Mobile No#</label>
                        <input type="tel" name="phone" id="phone" class="form-control" placeholder="Enter Mobile No. without '-' " required>
                    </div>
                    <?php if ($type == 'OUTDOOR') {?>
                    <div class="form-group col-md-6">
                        <label>Consultant Fee</label>
                        <input type="number" name="fee" id="fee" class="form-control" placeholder="Enter Consultant Fee" required>
                    </div>
                    <?php }?>
                </div>
                <?php if ($type == 'INDOOR') {?>
                <div class="form-group col-md-12">
                  <label>Procedure/Surgery Type</label>
                  <textarea style="height: 60px;" name="procedure" id="procedure" placeholder="Enter Procedure/Surgery Details Here ..." type="text" class="form-control" required></textarea>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <input type="text" name="staffId" id="staffId" value="<?php echo $_SESSION['uuid'] ; ?>" hidden readonly>
          <input type="text" name="slipId" id="slipId" hidden readonly>
          <input type="text" name="type" id="type" value="<?php echo $type; ?>" hidden readonly>
          <input type="text" name="subType" id="subType" value="<?php echo $subType; ?>" hidden readonly>
          <div class="card-footer">
            <button type="submit" name="submit" class="btn btn-block btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>
<!-- **
*  Outdoor Visitor Doctor Model Popup Here 
** -->
<div class="modal fade" id="visitor-doctor">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="nav-icon fas fa-user-md"></i> Visitor Doctor</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id="err-msg" style="display: none"></span>
      <form action="javascript:void(0)" method="post" id="visitorDoctor">
      <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" name="vtName" id="vtName" placeholder="Enter Doctor Name ..." required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Mobile</label>
                  <input type="text" class="form-control" name="vtMobile" id="vtMobile" placeholder="Enter Doctor Mobile ...">
                </div>
              </div>
            </div>
            <input type="text" name="staffId" id="staffId" value="<?php echo $_SESSION['uuid'] ; ?>" hidden readonly>
            <input type="text" name="uuId" id="uuId" hidden readonly>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" id="cancel" data-dismiss="modal">Cancel</button>
          <button type="submit" name="submit" class="btn btn-primary">Proceed</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- **
*  Outdoor Visitor Doctor Model Popup Ends Here 
** -->
<!-- Slip Script -->
<script src="dist/js/patient_script.js"></script>
<?php  
// Footer File
include('components/footer.php');
echo '</div>';
// Form Script Files
include('components/form_script.php');
}else{
echo '<script type="text/javascript">window.location = "login.php";</script>';
}
?>