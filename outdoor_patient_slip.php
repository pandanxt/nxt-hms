<?php 
  // Start Session 
  session_start();
  if (isset($_SESSION['uuid'])) {
  // Connection File
  include('backend_components/connection.php');
  // Form Header File
  include('components/form_header.php');
  // Navbar File
  include('components/navbar.php');
  // Sidebar File
  include('components/sidebar.php');
  
  // Check if ID is empty
  if (empty($_GET['id'])) {
?>

<div class="content-wrapper">
  <section class="content-header"></section>
    <section class="content">
      <div class="container-fluid">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"><i class="nav-icon fas fa-procedures"></i> Outdoor Patient Slip</h3>
            <div class="card-tools">
              <span id='clockDT'></span>
            </div>
          </div>
          <form action="javascript:void(0)" method="post" enctype="multipart/form-data" id="addSlip">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                      <div class="form-group col-md-4">
                          <label>Patient MR-ID #</label>
                          <input type="text" name="mrid" id="mrid" class="form-control" readonly>
                      </div>
                      <div class="form-group col-md-8">
                          <label>Patient Name</label>
                          <input type="text" name="name" id="name" class="form-control" placeholder="Enter Patient Name Here ..." required>
                      </div>
                  </div>
                  <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                      <div class="form-group col-md-6">
                      <label>Patient Gender</label>
                      <select class="form-control select2bs4" name="gender" id="gender" style="width: 100%;">
                          <option selected="selected" value="male">Male</option>
                          <option value="female">Female</option>
                          <option value="other">Other</option>
                      </select>
                      </div>
                      <div class="form-group col-md-6">
                          <label>Patient Age</label>
                          <input type="number" step="0.1" name="age" id="age" class="form-control" placeholder="Enter Age" required>
                      </div>
                  </div>
                    <div class="form-group col-md-12" >
                      <label for="switchList">Switch List: </label>
                      <select name="switchList" id="switchList" onchange="switchDocList(this.value);">
                        <option value="me">MedEast Doctors</option>
                        <option value="vt">Visiting Doctors</option>
                      </select>
                      <span id="addDoc" style="display:none;">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#visitor-doctor"><i class="fas fa-plus"></i> VISITOR DOCTOR</a>
                      </span>
                    </div>
                      <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                        <div class="form-group col-md-6">
                          <label>Department</label>
                          <select class="form-control select2bs4" id="dept" name="dept" style="width: 100%;" onchange="showDoctor(this.value)">
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
                        <div class="form-group col-md-6" id="meDoc">
                          <label>Consultant Name</label>
                            <select class="form-control select2bs4" name="doctor" style="width: 100%;" id="doctor">
                                <option disabled selected value="">---- Select Consultant Name ----</option>
                                <?php
                                $doctor = 'SELECT `DOCTOR_UUID`, `DOCTOR_NAME` FROM `me_doctor` WHERE `DOCTOR_STATUS` = "1"';
                                $result = mysqli_query($db, $doctor) or die (mysqli_error($db));
                                    while ($row = mysqli_fetch_array($result)) {
                                    $id = $row['DOCTOR_UUID'];  
                                    $name = $row['DOCTOR_NAME'];
                                    echo '<option value="'.$name.'">'.$name.'</option>'; 
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="col-md-12" style="display:flex;margin:0;padding:0;">
                      <div class="form-group col-md-6">
                          <label>Mobile No#</label>
                          <input type="tel" name="phone" id="phone" class="form-control" placeholder="Enter Mobile No. without '-' " required>
                      </div>
                      <div class="form-group col-md-6">
                          <label>Consultant Fee</label>
                          <input type="number" name="fee" id="fee" class="form-control" placeholder="Enter Consultant Fee" required>
                      </div>
                  </div>
                  <div class="form-group">
                    <label>Patient Address</label>
                    <textarea style="height: 120px;" name="address" id="address" type="text" class="form-control" placeholder="Enter Patient Address Here ..." required></textarea>
                    <input type="text" name="staffId" id="staffId" value="<?php echo $_SESSION['uuid'] ; ?>" hidden readonly>
                    <input type="text" name="slipId" id="slipId" hidden readonly>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer" style="text-align: right;">
              <button type="submit" name="submit" class="btn btn-block btn-primary">Submit</button>
            </div>
          </div>
        </form>
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
            <div class="form-group">
              <label>Doctor Name</label>
              <input type="text" class="form-control" name="docName" id="docName" placeholder="Enter Doctor Name ..." required>
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
<script src="dist/js/opd_script.js"></script>
<?php  
}else{
  // Update Emergency Patient
  include('backend_components/update_patient.php');
}
// Footer File
include('components/footer.php');
echo '</div>';
// Form Script Files
include('components/form_script.php');
}else{
echo '<script type="text/javascript">window.location = "login.php";</script>';
}
?>