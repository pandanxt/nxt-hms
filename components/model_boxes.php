<!-- Generate Followup Slip Model Popup Here -->
<div class="modal fade" id="generate-followup">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="nav-icon fas fa-wallet"></i> FollowUp Slip</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id="err-msg" style="display: none"></span>
      <form action="javascript:void(0)" method="post" id="ADD_FOLLOW_UP_SLIP">
        <div class="modal-body">
          <div class="row col-md-12">
            <div class="form-group col-md-6">
              <label>ID #</label>
              <input type="text" name="followId" id="followId" class="form-control" readonly>
            </div>
            <div class="form-group col-md-6">
              <label>Fee</label>
              <input type="number" name="fee" id="fee" class="form-control">
            </div>
          </div>
          <input type="text" name="staffId" id="staffId" value="<?php echo $_SESSION['uuid'] ; ?>" hidden readonly>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" name="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Generate Service Slip Model Popup Here -->
<div class="modal fade" id="generate-service">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="nav-icon fas fa-edit"></i> Service Slip</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id="err-msg" style="display: none"></span>
      <form action="javascript:void(0)" method="post" id="ADD_SERVICE_SLIP">
        <div class="modal-body">
          <div class="row">
            <div class="form-group col-md-6">
              <label>Service</label>
              <select class="form-control  select2" name="service" id="service" onchange="serviceChange(this)" required style="width: 100%;">
                <option disabled selected value="0">Select Title</option>
                <?php
                  $service = 'SELECT `SERVICE_UUID`,`SERVICE_NAME`,`SERVICE_RATE` FROM `me_general_service` WHERE `SERVICE_STATUS` = 1';
                  $result = mysqli_query($db, $service) or die (mysqli_error($db));
                    while ($row = mysqli_fetch_array($result)) {
                      $id = $row['SERVICE_UUID'];  
                      $name = $row['SERVICE_NAME'];
                      $rate = $row['SERVICE_RATE'];
                      echo '<option value="'.$rate.'" data-name="'.$name.'"><small>'.$name.'-'.$rate.'</small></option>'; 
                  }
                ?>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label>Discount</label>
              <input type="text" name="discount" id="discount" onchange="serviceDiscount(this)" class="form-control" disabled>
            </div>
            <div class="form-group col-md-3">
              <label>Fee</label>
              <input type="text" name="finalBill" id="finalBill" class="form-control" readonly>
            </div>
          </div>
          
          <input type="text" name="staffId" id="staffId" value="<?php echo $_SESSION['uuid'] ; ?>" hidden readonly>
          <input type="text" name="serviceId" id="serviceId" hidden readonly>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" name="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Select Slip Type To Add Slip Model -->
<div class="modal fade" id="modal-slip">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">CHOOSE SLIP TYPE</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="add_slip.php">
        <div class="modal-body">
          <select class="form-control  select2" name="type" id="type" style="width: 100%;" required>
            <option value="" selected disabled>SELECT SLIP TYPE</option>
            <option value="OUTDOOR">OUTDOOR PATIENT SLIP</option>
            <option value="INDOOR">INDOOR PATIENT SLIP</option>
            <option value="EMERGENCY">EMERGENCY PATIENT SLIP</option>      
          </select>
          <div id="select">
            <br>
            <select class="form-control  select2" name="subType" id="subType" style="width: 100%;">
              <option value="" selected disabled>SELECT INDOOR TYPE</option>
              <option value="GYNEACOLOGY_PATIENT">GYNAE/OBS PATIENT</option>
              <option value="GENERAL_SURGERY_PATIENT">GENERAL SURGERY PATIENT</option>
              <option value="GENERAL_ILLNESS_PATIENT">GENERAL ILLNESS PATIENT</option>
              <option value="EYE_PATIENT">EYE PATIENT</option>
            </select>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Proceed</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Select Report Filter Model -->
<div class="modal fade" id="modal-report">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Choose Report Filter</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="reports.php">
        <div class="modal-body">
          <div class="col-md-12">
            <div class="col-12 mb-2">
              <label>Report Type</label>
              <select class="form-control  select2" name="type" id="reportType" style="width: 100%;" required>
                <option value="" selected disabled>Select Report Type</option>
                <option value="DAILY">Daily Report</option>
                <option value="DATE_RANGE">B/W Dates Report</option>
                <!-- <option value="MONTH">Month Report</option> -->
              </select>
            </div>
            <div class="col-12" id="dateRange">
              <div class="form-group">
                <label>Date Range</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input type="text" class="form-control float-right" name="reservation" id="reservation">
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="row">
                <div class="col-4">
                  <label>Doctor Share</label>
                  <input type="number" step="any" class="form-control" placeholder="Select Doctor Share" name="docShare" id="docShare" required>
                </div>
                <div class="col-4">
                  <label>Clinic Share</label>
                  <input type="number" step="any" class="form-control" placeholder="Select Clinic Share" name="hosShare" id="hosShare" required>
                </div>
                <div class="col-4">
                  <label>Reception Share</label>
                  <input type="number" step="any" class="form-control" placeholder="Select Reception Share" name="recShare" id="recShare" required>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Proceed</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--Edit Slip Model Popup Here -->
<div class="modal fade" id="edit-slip">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="nav-icon fas fa-procedures"></i>&nbsp;Edit Slip</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id="err-msg" style="display: none"></span>
      <form action="javascript:void(0)" method="post" id="editSlip">
        <div class="modal-body" id="editSlipForm">
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" id="cancel" data-dismiss="modal">Cancel</button>
          <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- View history Model Popup Here -->
<div class="modal fade" id="view-history">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="nav-icon fas fa-edit"></i> Edit History</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <table class="table table-bordered table-striped table-hover" id="historyTable">  
          </table>
        </div>
    </div>
  </div>
</div> 
<!-- View Service Slip Model Popup Here -->
<div class="modal fade" id="view-service">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="nav-icon fas fa-sticky-note"></i> Service Slips</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <table class="table table-bordered table-striped table-hover" id="serviceSlipTable">  
          </table>
        </div>
    </div>
  </div>
</div>
<!--Select Slip Type To Add Slip Model Popup Against Patient -->
<div class="modal fade" id="patient-slip">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">CHOOSE SLIP TYPE</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="patient_slip.php">
        <div class="modal-body">
          <select class="form-control  select2" name="patType" id="patType" style="width: 100%;" required>
            <option value="" selected disabled>SELECT SLIP TYPE</option>
            <option value="OUTDOOR">OUTDOOR PATIENT SLIP</option>
            <option value="INDOOR">INDOOR PATIENT SLIP</option>
            <option value="EMERGENCY">EMERGENCY PATIENT SLIP</option>      
          </select>
          <div id="patSelect">
            <br>
            <select class="form-control  select2" name="patSubType" id="patSubType" style="width: 100%;">
              <option value="" selected disabled>SELECT INDOOR TYPE</option>
              <option value="GYNEACOLOGY_PATIENT">GYNAE/OBS PATIENT</option>
              <option value="GENERAL_SURGERY_PATIENT">GENERAL SURGERY PATIENT</option>
              <option value="GENERAL_ILLNESS_PATIENT">GENERAL ILLNESS PATIENT</option>
              <option value="EYE_PATIENT">EYE PATIENT</option>
            </select>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Proceed</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--Add Patient Model Popup Here -->
<div class="modal fade" id="add-patient">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="nav-icon fas fa-procedures"></i>&nbsp;Add Patient</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id="err-msg" style="display: none"></span>
      <form action="javascript:void(0)" method="post" id="addPatient">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12" style="display:flex;">
              <div class="form-group col-md-6">
                <label>Patient MR-ID</label>    
                <input type="text" name="patientMrId" class="form-control" id="patientMrId" readonly>
              </div>
              <div class="form-group col-md-6">
                <label>Patient Name</label>
                <input type="text" name="patientName" class="form-control" id="patientName" placeholder="Enter Full Name" required>
              </div>
            </div>   
            <div class="col-md-12" style="display:flex;">
              <div class="form-group col-md-6">
                <label>Mobile No.</label>
                <input type="tel" name="patientPhone" class="form-control" id="patientPhone" placeholder="Enter Valid Phone No." required>
              </div>
              <div class="form-group col-md-6">
                <label>Patient Gender</label>
                <select class="form-control  select2" name="patientGender" id="patientGender" style="width: 100%;">
                  <option selected="selected" disabled>Select Gender</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                </select>
              </div>
            </div>
            <div class="col-md-12" style="display:flex;">
              <div class="form-group col-md-6">
                <label>Patient Age</label>
                <input type="number" name="patientAge" class="form-control" id="patientAge" placeholder="Enter Age Here" required>
              </div>
              <div class="form-group col-md-6">
                <label>Patient Address</label>
                <textarea style="height: 38px;" name="patientAddress" type="text" class="form-control" id="patientAddress" placeholder="Enter Patient Address" required></textarea>
              </div>
            </div>   
            <input type="text" name="patientBy" id="patientBy" value="<?php echo $_SESSION['uuid'] ; ?>" hidden readonly>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" id="cancel" data-dismiss="modal">Cancel</button>
          <button type="submit" name="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--Edit Patient Model Popup Here -->
<div class="modal fade" id="edit-patient">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="nav-icon fas fa-procedures"></i>&nbsp;Edit Patient</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id="err-msg" style="display: none"></span>
      <form action="javascript:void(0)" method="post" id="editPatient">
        <div class="modal-body" id="editPatientForm">
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" id="cancel" data-dismiss="modal">Cancel</button>
          <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- User Profile Related Popups -->
<!-- View User Model Popup Ends Here -->
<div class="modal fade" id="view-user">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="nav-icon fas fa-user-md"></i> Medeast User</h4>
        <button onclick="autoRefresh()" type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id="err-msg" style="display: none"></span>
      <div class="modal-body" id="viewUser">
      </div>
    </div>
  </div>
</div>
<!-- Update User Model Popup Here -->
<div class="modal fade" id="edit-user">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="nav-icon fas fa-user-md"></i> Medeast User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id="err-msg" style="display: none"></span>
      <form action='javascript:void(0)' method='post' id='editUser'>
        <div class='modal-body' id='editForm'>
        </div>
        <div class='modal-footer justify-content-between'>
            <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            <button type='submit' name='submit' class='btn btn-primary'>Save</button>
        </div>
      </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- Update User Password Model Popup Here -->
<div class="modal fade" id="pass-user">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="nav-icon fas fa-user-md"></i>Update Password</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id="err-msg" style="display: none"></span>
      <form action='javascript:void(0)' method='post' id='passUser'>
        <div class='modal-body'>
          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="userpassword" id="userpassword" placeholder="Enter Strong Password ..." pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
          </div>
        </div>
        <div class='modal-footer justify-content-between'>
            <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            <button type='submit' name='submit' class='btn btn-primary'>Save</button>
        </div>
      </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>