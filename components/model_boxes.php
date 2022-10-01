<!-- Generate Edit Request Model Popup Here -->
<div class="modal fade" id="generate-request">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="nav-icon fas fa-edit"></i> Request</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id="err-msg" style="display: none"></span>
      <form action="javascript:void(0)" method="post" id="ADD_REQUEST">
        <div class="modal-body">
          <div class="form-group">
            <label>Title</label>
            <select class="form-control select2bs4" name="title" id="title" style="width: 100%;">
              <option disabled selected>Select Title</option>
              <option value="cancel">Cancel Slip</option>
              <option value="update">Update Slip</option> 
            </select>
          </div>
          <div class="form-group">
            <label>Comment</label>
            <textarea type="text" name="comment" class="form-control" id="comment" placeholder="Enter Reason of Request ..." required></textarea>
          </div>
          <input type="text" name="staffId" id="staffId" value="<?php echo $_SESSION['uuid'] ; ?>" hidden readonly>
          <input type="text" name="reqId" id="reqId" hidden readonly>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" name="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

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
              <select class="form-control select2bs4" name="service" id="service" onchange="serviceChange(this)" required style="width: 100%;">
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

<!-- View Request Model Popup Here -->
<!-- <div class="modal fade" id="view-request">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="nav-icon fas fa-edit"></i> Request</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="javascript:void(0)" method="post" id="VIEW_REQUEST">
        <div class="modal-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr style="font-size: 14px;">
              <th>Title</th>
              <th>Comment</th>
              <th>Status</th>
              <th>Created</th>
              <th>Option</th>
            </tr>
            </thead>
            <tbody id="body"></tbody>
            </table>
        </div>
      </form>
    </div>
  </div>
</div> -->
  
<!-- Edit Request Model Popup Here -->
<div class="modal fade" id="edit-request">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="nav-icon fas fa-edit"></i> Request</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id="err-msg" style="display: none"></span>
      <form action="javascript:void(0)" method="post" id="EDIT_REQUEST">
      </form>
    </div>
  </div>
</div>

<!--  View Request Model Popup With User And Admin Access -->
<div class="modal fade" id="view-request">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="nav-icon fas fa-edit"></i> Request</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
          <span aria-hidden="true" onclick="setPopModel();">&times;</span>
        </button>
      </div>
      <form action="javascript:void(0)" method="post" id="VIEW_REQUEST">
        <div class="modal-body">
          <table class="table table-bordered table-striped">
            <thead>
            <tr style="font-size: 12px;">
              <th>Title</th>
              <th>Comment</th>
              <th>Type</th>
              <th>Request By</th>
              <?php if ($_SESSION['role'] == "admin") { ?>
              <th>  Options-  </th>
              <?php } ?>
            </tr>
            </thead>
            <tbody id="requestBody"></tbody>
          </table>
          <?php if (isset($_SESSION['uuid']) && $_SESSION['role'] == "admin") {  ?>
          <div id="editBody">
          </div>
          <?php } ?>
        </div>
        <?php if (isset($_SESSION['uuid']) && $_SESSION['role'] == "admin") {  ?>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="setPopModel();">Cancel</button>
          <button type="submit" name="submit" class="btn btn-primary" id="updateRecord" onclick="updateRqRecord();">Save</button>
        </div>
        <?php } ?>
      </form>
    </div>
  </div>
</div>

<!-- Select Slip Type Model -->
<div class="modal fade" id="modal-slip">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Choose Slip Type</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="add_slip.php">
        <div class="modal-body">
          <select class="form-control select2bs4" name="type" id="type" style="width: 100%;" required>
            <option value="" selected disabled>Select Slip Type</option>
            <option value="OUTDOOR">OUTDOOR PATIENT SLIP</option>
            <option value="INDOOR">INDOOR PATIENT SLIP</option>
            <option value="EMERGENCY">EMERGENCY PATIENT SLIP</option>      
          </select>
          <div id="select">
            <br>
            <select class="form-control select2bs4" name="subType" id="subType" style="width: 100%;">
              <option value="" selected disabled>Select Indoor Type</option>
              <option value="GYNEACOLOGY_PATIENT">GYNEACOLOGY PATIENT</option>
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

<!-- Select Report Model -->
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
          <div class="row col-md-12">
              <!-- <div class="col-md-6">
                <label>Date Range</label>
                <select class="form-control select2bs4" name="dateRange" id="dateRange" style="width: 100%;" required>
                  <option value="0" selected disabled>Select Range</option>
                  <option value="0">TODAY</option>
                  <option value="1">YESTERDAY</option>
                  <option value="7">LAST 7 DAYS</option>
                  <option value="15">LAST 15 DAYS</option>
                  <option value="30">LAST 30 DAYS</option>
                  <option value="30">ONE MONTH</option>
                  <option value="60">TWO MONTHS</option>      
                </select>
              </div> -->
              <div class="col-md-6">
              <label>Doctor Share</label>
                <select class="form-control select2bs4" name="docShare" id="docShare" style="width: 100%;" required>
                  <option value="0" selected disabled>Select Doctor Share</option>
                  <option value="30">30% SHARE</option>
                  <option value="40">40% SHARE</option>
                  <option value="50">50% SHARE</option>
                  <option value="60">60% SHARE</option>      
                  <option value="70">70% SHARE</option>
                </select>
              </div>
              <div class="col-md-6">
              <label>Clinic Share</label>
                <select class="form-control select2bs4" name="hosShare" id="hosShare" style="width: 100%;" required>
                  <option value="0" selected disabled>Select Clinic Share</option>
                  <option value="30">30% SHARE</option>
                  <option value="40">40% SHARE</option>
                  <option value="50">50% SHARE</option>
                  <option value="60">60% SHARE</option>      
                  <option value="70">70% SHARE</option>
                </select>
              </div>
          </div>
          
          <div class="row col-md-12 mt-2">
             
              <!-- <div class="col-md-6"> -->
              <label>Reception Share</label>
                <select class="form-control select2bs4" name="recShare" id="recShare" style="width: 100%;" required>
                  <option value="0" selected disabled>Select Recep Share in %</option>
                  <option value="1.00">1% SHARE</option>
                  <option value="1.25">1.25% SHARE</option>
                  <option value="1.50">1.50% SHARE</option>      
                  <option value="1.75">1.75% SHARE</option>
                  <option value="2.00">2.00% SHARE</option>
                  <option value="2.25">2.25% SHARE</option>
                  <option value="2.50">2.50% SHARE</option>
                </select>
              <!-- </div> -->
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

<!-- Log Out Popup Model -->
<div class="modal fade" id="modal-sm">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Confirm To Logout</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you Sure? You want to Logout&hellip;</p>
        <p>Or click <b>Cancel</b> to continue &hellip;</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a type="submit" href="logout.php" class="btn btn-danger">Log Out</a>
      </div>
    </div>
  </div>
</div>